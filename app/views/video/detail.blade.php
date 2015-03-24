<!-- Main hero unit for a primary marketing message or call to action -->
<div class="hero-unit">
  <center>
    <h2 class="_title"><b>{{$video->title}}<b> </h2>
    <h4>exist during  <span id="runner"></span> !</h4>
  </center>

  
  

  <!-- video div -->  
  <center>
    <video id="myVideo" controls width="600" height="400" >
      <source src="{{$video->link}}" type="video/mp4" />    
      <p>Your browser does not support the video tag.</p>       
    </video>
       
    <br>
    <!-- share div  -->
      <h3> IF YOU LIKE, SHARE IT </h3>
      <div data-type="button_count" class="fb-share-button" data-href="<?php echo URL::current(); ?>" data-width="600"></div>
      <a href="<?php echo URL::current(); ?>" class="twitter-share-button" data-text="Flush Video">Tweet</a>
    <br>
  </center> 
  <!-- add new comment -->
  <center>
    <input name="video_id" id="video_id" type="hidden" value="{{ $video->id}}">
    <textarea class="_cmt-textare" row ="10"  name="content" id="content" placeholder="コメート" ></textarea><br>
    <button class="_btn" type="button" id="submitButton" name="Submit">Submit</button>
  </center>

  <!-- new comment -->
  <div id="new-comment"></div>

  <!-- error -->
  <div id="error"></div>

  <!-- show comment -->
  <div>
      @foreach ($comments as $comment)
      <p>
          {{ HTML::linkAction('UserController@getShow', $comment->comment_username , array($comment->comment_userid), array('class' => '_cmt-username')) }}
          <span class="_cmt-content">{{$comment->content}}</span>
      </p>
     @endforeach
  </div>
</div>

@section('javascript')
<script type="text/javascript">
  $(function() {
    //Ajax for comment
      $("#submitButton").click(function(e){
      e.preventDefault();
      var commentContent = $("#content").val();
      var videoID = $("#video_id").val();
      var myUrl = "{{URL::action('CommentController@postStore')}}";
      $.ajax({
        url: myUrl,
        type: 'POST',
        data:{
          content: commentContent,
          video_id: videoID
        },
        dataType: 'json',
        success: function (data) {
          if (data.msg == "SUCCESS"){
            $("#new-comment").prepend("<p class='_cmt-content'>" + data.content + "</p>");
            $("#content").val(" ");
          }
          else {
            $("#new-comment").html('');
            var content = '<ul>';
            jQuery.each(data.content, function(i, v){
              content += "<li class = 'error'>" + v + "</li>";
            });
            content += '</ul>';
            $("#error").html(content);
          }
        },
        error: function(data) {
          console.log(data);
        }
        })
      });

      // countdown clock
      $('#runner').runner({
        autostart: true,
        countdown: true,
        milliseconds: false,
        startAt: {{ $count_down * 1000 }}, // count_down in milisecond
        stopAt:0
      }).on('runnerFinish', function(eventObject, info) {
        alert('Video has expired !!! ');
        location.reload();
      });

      // set video duration to 5 second
      var showtime = 5; // 5 second
      var video = $('#myVideo');      
      var duration = video[0].duration;
      var backrate = duration/showtime;
      console.log(video);
      console.log(video[0].duration);
      video[0].playbackRate = backrate ;
  });

</script>
@stop