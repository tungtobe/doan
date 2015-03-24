
<center>
<div class="hero-unit">
	<h1>This Video has been expired</h1>
	<br>
	@if(Auth::check())
		<input type="button" value="I want this video REBORN" class="_btn" id="reborn-btn">
	@else
		<h3>{{ HTML::linkAction('AuthenController@getLogin', "Login for ask this video reborn", null, array('class' => '_btn') ) }}</h3>
	@endif
</div>
</center>


@if(Auth::check() )
@section('javascript')
<script type="text/javascript">
$(function() {
  //Ajax

  	$("#reborn-btn").click(function(e){
	    e.preventDefault();
	    var videoID = {{$id}};
	    var userID = {{Auth::user()->id}}; 
	    var myUrl = "{{URL::action('VideoController@requestReborn')}}";   
	    $.ajax({
	        url: myUrl,
	        type: 'POST',
	        data:{
	          user_id: userID,
	          video_id: videoID
	        },
	        dataType: 'json',
	        success: function (data) {
	        	console.log(data);
	          	if(data.msg=="SUCCESS"){
	           		alert(data.text); 
	           		$("#reborn-btn").attr('disabled','disabled');  
	           		$("#reborn-btn").val("Requested");  
	         	}
	          	else if (data.msg=="DUPLICATE"){          
	            	alert(data.text);
	            	$("#reborn-btn").attr('disabled','disabled');  
	            	$("#reborn-btn").val("Requested");  
	          	}else {
	          		alert(data.text);
	          		        	
	          	}
	        },
	        error: function(data) {
	            console.log(data);
	        }
	    })
  }); 
});

</script>
@stop

@endif