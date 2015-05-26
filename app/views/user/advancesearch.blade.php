<div class="container _container">
	<div class="col-md-3">
		<div class="_well-1">
		    <h3> Advance Search </h3>
			
			<div class="wrap">
				{{Form::open(array('action' => array('HomeController@postAdvanceSearch'),'id' => 'adv_search')) }}
				<div class="title"> Manufactorer </div>
					@foreach ($manufacturer as $manu)
					<input type="checkbox" name="manufacturer[]"  value="{{$manu['value']}}" />
					{{$manu['value']}}
					<br>
					@endforeach

				<div class="title"> Operation System </div>
					@foreach ($os as $o)
					<input type="checkbox" name="os[]"  value="{{$o['value']}}" />
					{{$o['value']}}
					<br>
					@endforeach

				<div class="title"> Camera</div>
					@foreach ($cameras as $camera)
					<input type="checkbox" name="cameras[]"  value="{{$camera['value']}}" />
					{{$camera['value']}}
					<br>
					@endforeach


				<div class="title"> Price </div>
					<input type="radio" name="price" value="1"> Less than 3.000.000 VND</input><br>
					<input type="radio" name="price" value="2"> 3.000.000 -> 5.000.000 VND</input><br>
					<input type="radio" name="price" value="3"> 5.000.000 -> 10.000.000 VND</input><br>
					<input type="radio" name="price" value="4"> 10.000.000 -> 20.000.000 VND</input><br>
					<input type="radio" name="price" value="5"> More than  20.000.000 VND</input><br>

				<button id="submit_btn" class="btn btn-primary btn-lg _btn-search" >Search</button>
			{{Form::close()}}
			</div>
		</div>
	</div>

	<div class="col-md-9 well _well">  
		<center>
	    	<h3> Result </h3>
	    </center>
	    <div class="spinner" hidden>
		  <div class="bounce1"></div>
		  <div class="bounce2"></div>
		  <div class="bounce3"></div>
		</div>

	    <div id="result"> 

	    			
                    
	    </div>
		
	</div>
</div>


<script type="text/javascript">
$(function() {
	   $("#adv_search").submit(function() {
          var url = "{{URL::action('HomeController@postAdvanceSearch')}}"; 
          $.ajax({
                 type: "POST",
                 url: url,
                 data: $("#adv_search").serialize(), // serializes the form's elements.
                 error:function(err){
                  console.log(err);
                 },
                 beforeSend:function(){
                  $('.spinner').show();
                  $("#result").empty();
                 },
                 success: function(e)
                 {
                    $('.spinner').hide();
                    $("#result").empty();
                    $("#result").html(e);
                 }
               });
          return false; // avoid to execute the actual submit of the form.
      });

});
</script>