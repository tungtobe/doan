<div class='hero-unit'>    
    <div class="product-info-top clearfix">

        <div class="product-info-top-left">
            <div class="module-product-img-gallery">
                <div class="widget-image-product">
                    <a href="{{ $item_attr['6'] }}" id="link_main_thumb" onclick="return showGalleryPopup();" rel="nofollow">
                        <img alt="{{ $item->name }}" id="img_main_thumb" itemprop="image" src="{{$item_attr['6'] }}" style="max-width: 350px;">
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


            <!-- Comment Part -->
            @if(Auth::check())
            <!-- add new comment -->
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
            </center>
            
        </div>

        <div class="product-info-top-right">
            <div class="product-main-info">
                <h1 class="product-detail-title">{{ $item->name }}</h1>
                
            </div>

            <br>

              

             {{ Form::open(array('action' => 'RecommendController@reciveCritique', 'id' => 'critique')) }}
             <input type="hidden" name="current_item" value="{{$item->id}}">
            <div class="clearfix">
                <div class="module-product-main-info pull-left fade-line-divide-before">
                    <div class="desc-main-attr">
                        <table class="table">
                          <tbody>
                            <?php while ($attr_id = key($item_attr)) { ?>
                              <?php $attr = Attribute::find($attr_id); ?>
                              @if($attr->attr_name != 'IMG')
                                  <tr>
                                    <td > {{$attr->attr_name }} </td>
                                    @if($item_attr_type[$attr->attr_name ]=="Boolean")
                                      @if($item_attr[$attr_id]=1)
                                      <td style="padding-left:100px; font-weight: bold;" > Yes </td>
                                      @else
                                      <td style="padding-left:100px; font-weight: bold;" > No </td>
                                      @endif
                                    @else
                                    <td style="padding-left:100px; font-weight: bold;" > {{$item_attr[$attr_id]}} </td>
                                    @endif

                                    @if(Auth::check())
                                    <td style="padding-left:100px;" > <select name="attr[{{$attr_id}}]">
                                                                        <option   value="">Select improve</option>
                                                                        @foreach($item_attr_option[$attr_id] as $option)
                                                                        <option  value="{{$option['value']}}">{{$option['value']}}</option>
                                                                        @endforeach
                                                                      </select>
                                    </td>  
                                    @endif

                                  </tr>
                              @endif
                            <?php next($item_attr);} ?>

                          </tbody>
                        </table>
                      </div>
                      <center>
                        @if(Auth::check())
                        <button type='submit' class="btn btn-primary"> Find better item</button>
                        @else
                        {{ HTML::linkAction('AuthenController@getLogin','Login for recommendation',array(), array('class' => 'btn btn-primary')) }}
                        @endif
                      </center>
                      
                    </div>
                </div>
                {{ Form::close() }}
            </div>

            
        </div>
    </div>

<pre>
Phần dưới sẽ trình bày 10 sản phẩm được gợi ý, về cấu trúc giống với giao diện sản phẩm ở trang chủ nhưng có thêm một số thứ: 
- Thứ tự các sản phẩm : có những cái nhãn để thể hiện thứ tự 1,2,3,4,5 của sản phẩm 
- Sẽ có những sản phẩm có trong favorite của người dùng, những sản phẩm này cần được trình bày khác đi 
hoặc gán nhãn nào đó thể hiện là sản phẩm đã có trong favorite
- Thêm 2 dòng trong mỗi sản phẩm với nội dung : 
  + x of your friends vote GOOD for this item
  + x of your expert vote GOOD for this item

Chị để ý nó có thời gian loading ... , chị design cho e cả cái loading đấy luôn nhé
</pre>
<div id="recommend_list" class="hero-unit">

  
</div>

<script type="text/javascript">
$(function() {

      // this is the id of the form
      $("#critique").submit(function() {
          var url = "{{URL::action('RecommendController@reciveCritique')}}"; 
          $.ajax({
                 type: "POST",
                 url: url,
                 data: $("#critique").serialize(), // serializes the form's elements.
                 success: function(data)
                 {
                     console.log
                     (data); // show response from the php script.
                 }
               });
          return false; // avoid to execute the actual submit of the form.
      });

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
      var myUrl = "{{URL::action('ItemController@postStore')}}";
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


      $( document ).ready(function() {
        var myUrl = "{{ URL::action('RecommendController@getFirstRecommend') }}";
        $.ajax({
          url: myUrl,
          type: 'POST',
          data:{
            id: {{ $item->id }}
          },
          dataType: 'html',
          beforeSend: function(){
            $("#recommend_list").append("Loading ... ");
          },
          success: function (e) {
            $("#recommend_list").empty();
            $("#recommend_list").html(e);
          },
          error: function(data) {
            console.log(data);
          }
        })
      });
});
</script>