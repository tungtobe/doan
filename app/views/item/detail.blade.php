<div class='hero-unit'>    
    <div class="product-info-top clearfix">
        <div class="product-info-top-left">
            <div class="module-product-img-gallery">
                <div class="widget-image-product">
                    <a href="{{ $item_attr['IMG'] }}" id="link_main_thumb" onclick="return showGalleryPopup();" rel="nofollow">
                        <img alt="{{ $item->name }}" id="img_main_thumb" itemprop="image" src="{{$item_attr['IMG'] }}" style="max-width: 350px;">
                    </a>
                     <div class="clear"></div>
                </div>
            </div>
            <center>
              @if (Auth::check()) 
                <br><a id='add_favorite'><button class='btn btn-primary'>Add to Favorite</button></a>
            @endif

            <div class="vote-div">
              @if (Auth::check()) 
              VOTE <br>
              @if(is_null($vote_type))
                <button id='vote_good' class='btn btn-info' style="opacity:0.2;" >GOOD</button>
                <button id='vote_bad' class='btn btn-danger' style="opacity:0.2;">BAD</button>
              @elseif($vote_type==1)
                <button id='vote_good' class='btn btn-info' >GOOD</button>
                <button id='vote_bad' class='btn btn-danger' style="opacity:0.2;">BAD</button>
              @else
                <button id='vote_good' class='btn btn-info' style="opacity:0.2;" >GOOD</button>
                <button id='vote_bad' class='btn btn-danger'>BAD</button>
              @endif  
            @endif
            </div>
            </center>
            
        </div>
        <div class="product-info-top-right">
            <div class="product-main-info">
                <h1 class="product-detail-title">{{ $item->name }}</h1>
                
            </div>

            <br>

              

            
            <div class="clearfix">
                <div class="module-product-main-info pull-left fade-line-divide-before">
                    <div class="desc-main-attr">
                        <table class="table">
                          <tbody>
                            <?php while ($value = current($item_attr)) { ?>
                              @if(key($item_attr) != 'IMG')
                                  <tr>
                                    <td > {{key($item_attr)}} </td>
                                    @if($item_attr_type[key($item_attr)]=="Boolean")
                                      @if($value=1)
                                      <td style="padding-left:100px; font-weight: bold;" > Yes </td>
                                      @else
                                      <td style="padding-left:100px; font-weight: bold;" > No </td>
                                      @endif
                                    @else
                                    <td style="padding-left:100px; font-weight: bold;" > {{$value}} </td>
                                    @endif
                                    <td style="padding-left:100px;" > {{$item_attr_type[key($item_attr)]}} </td>  
                                  </tr>
                              @endif
                            <?php next($item_attr);} ?>

                          </tbody>
                        </table>
                      </div>
                            <ul class="option-product product-detail-options clearfix">
                                <?php 
                                    while ($value = current($item_attr)) {
                                            echo key($item_attr).' :: '. $value .' :: '.$item_attr_type[key($item_attr)] .'</br>';
                                        next($item_attr);
                                    }
                                ?>
                            </ul>
                    </div>
                </div>
                
            </div>

            
        </div>
    </div>
</div>

<div class="hero-unit">

    @if(Auth::check())
<!-- add new comment -->
  <center>
    <input name="item_id" id="item_id" type="hidden" value="{{ $item->id}}">
    <textarea class="_cmt-textare" row ="10"  name="content" id="content" placeholder="Comment" ></textarea><br>
    <button class="btn btn-success" type="button" id="submitButton" name="Submit">Submit</button>
  </center>

  <div id="new-comment"></div>

  @endif
  <!-- show comment -->
  <div>
      @foreach ($comments->reverse() as $comment)
      <p>
          {{ HTML::linkAction('UserController@getShow', $comment->user->username , array($comment->user->id), array('class' => '_cmt-username')) }}
          <span class="_cmt-content">{{$comment->content}}</span>          
      </p>
     @endforeach
  </div>
</div>

<script type="text/javascript">
$(function() {
    $("#vote_good").click(function(e){
        $.ajax({
            url: '{{ URL::action('ItemController@vote') }} ',
            type: 'POST',
            dataType: 'json',
            data: {
                id: {{ $item->id }},
                type: 1
            },
            error: function(err) {
                console.log(err);
            },
            success: function(res) {
                if (res.mes == 'OK') {
                   $("#vote_good").css('opacity','1');
                   $("#vote_bad").css('opacity','0.2');
                }
                else{
                  $("#vote_good").css('opacity','0.2');
                }                   
            }
        });
    });

    $("#vote_bad").click(function(e){
        $.ajax({
            url: '{{ URL::action('ItemController@vote') }} ',
            type: 'POST',
            dataType: 'json',
            data: {
                id: {{ $item->id }},
                type: 2
            },
            error: function(err) {
                console.log(err);
            },
            success: function(res) {
                // vote bad done
                if (res.mes == 'OK') {
                   $("#vote_bad").css('opacity','1');
                   $("#vote_good").css('opacity','0.2');
                }
                // unvote bad
                else{
                  $("#vote_bad").css('opacity','0.2');
                }                   
            }
        });
    });

    $("#add_favorite").click(function(e){
        $.ajax({
            url: '{{ URL::action('ItemController@addFavorite') }} ',
            type: 'POST',
            dataType: 'json',
            data: {
                id: {{ $item->id }}
            },
            error: function(err) {
                console.log(err);
            },
            success: function(res) {
                alert(res.mes);                    
            }
        });
    });

    //Ajax for comment
      $("#submitButton").click(function(e){
      e.preventDefault();
      var commentContent = $("#content").val();
      var itemID = $("#item_id").val();
      var myUrl = "{{URL::action('CommentController@postStore')}}";
      $.ajax({
        url: myUrl,
        type: 'POST',
        data:{
          content: commentContent,
          item_id: itemID
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
});
</script>