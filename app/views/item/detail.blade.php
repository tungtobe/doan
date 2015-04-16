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
        </div>
        <div class="product-info-top-right">
            <div class="product-main-info">
                <h1 class="product-detail-title">{{ $item->name }}</h1>
                
            </div>

            <br>
            @if (Auth::check()) 
                <a id='add_favorite'><button class='btn btn-primary'>Add to Favorite</button></a>
            @endif
            <div class="clearfix">
                <div class="module-product-main-info pull-left fade-line-divide-before">
                    <div class="desc-main-attr">
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