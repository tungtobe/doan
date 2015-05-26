 <div class="col-md-9">

        <div class="col-md-2">
          <center>
            <div class="module-product-img-gallery">
                <div class="widget-image-product">
                    <a href="{{ $item_attr['6'] }}" id="link_main_thumb" onclick="return showGalleryPopup();" rel="nofollow">
                        <img alt="{{ $item->name }}" id="img_main_thumb" itemprop="image" src="{{$item_attr['6'] }}" style="max-width: 150px;">
                    </a>
                     <div class="clear"></div>
                </div>
            </div>
            
                @if (Auth::check()) 
                <br><a id='add_favorite'><button class='btn btn-primary'>Add to Favorite</button></a>
                <div class="vote-div">
                VOTE <br>
                @if(is_null($vote_type))
                    <button id='vote_good' class='btn btn-primary btn-sm' style="width: 60px; opacity:0.2;" >GOOD</button>
                    <button id='vote_bad' class='btn btn-danger btn-sm' style="width: 60px; opacity:0.2;">BAD</button>
                @elseif($vote_type==1)
                    <button id='vote_good' class='btn btn-primary btn-sm' style="width: 60px;" >GOOD</button>
                    <button id='vote_bad' class='btn btn-danger btn-sm' style="width: 60px; opacity:0.2;">BAD</button>
                @else
                    <button id='vote_good' class='btn btn-primary btn-sm' style="width: 60px; opacity:0.2;" >GOOD</button>
                    <button id='vote_bad' class='btn btn-danger btn-sm' style="width: 60px;">BAD</button>
                @endif  
                </div>
                @endif
            </center>
            
        </div>

        <div class="col-md-10">
            <div class="product-main-info">
                <h2 class="product-detail-title">{{ $item->name }}</h2>
            </div>
            {{ Form::open(array('action' => 'RecommendController@critique', 'id' => 'critique')) }}
            <input type="hidden" name="current_item" value="{{$item->id}}">
            <div class="clearfix">
                <div class="module-product-main-info pull-left fade-line-divide-before _width_100">
                    <div class="desc-main-attr">
                        <table class="table _table">
                          <tbody>
                            <?php while ($attr_id = key($item_attr)) { ?>
                              <?php $attr = Attribute::find($attr_id); ?>
                              @if($attr->attr_name != 'IMG' && $attr->attr_name != 'Name')
                                  <tr>
                                    <td style="min-width:150px;" class="_gray"> {{$attr->attr_name }} </td>
                                    @if($item_attr_type[$attr->attr_name ]=="Boolean")
                                      @if($item_attr[$attr_id]=1)
                                      <td style="min-width:200px; padding-left:40px; font-weight: bold;" > Yes </td>
                                      @else
                                      <td style="min-width:200px; padding-left:40px; font-weight: bold;" > No </td>
                                      @endif
                                    @else
                                    <td style="min-width:200px; padding-left:40px; font-weight: bold;" > {{$item_attr[$attr_id]}} </td>
                                    @endif

                                    @if(Auth::check())
                                      @if ($attr->attr_type == "Integer" || $attr->attr_type == "Float")
                                      <?php 
                                      $ranges = Valuerange::where('attr_id',$attr->id)->get();
                                       ?>
                                      <td style="min-width:200px; padding-left:40px;" > <select class="form-control input-sm" name="attr[{{$attr_id}}]">
                                                                        <option   value="">Select improve</option>
                                                                        @if($ranges->count() > 0)
                                                                          @foreach($ranges as $range)
                                                                          <option  value="{{$range->value_range}}">{{$range->value_range}}</option>
                                                                          @endforeach
                                                                        @endif
                                                                      </select>
                                      </td> 
                                      @else
                                      <td style="min-width:200px; padding-left:40px;" > <select class="form-control input-sm" name="attr[{{$attr_id}}]">
                                                                        <option   value="">Select improve</option>
                                                                        @foreach($item_attr_option[$attr_id] as $option)
                                                                        <option  value="{{$option['value']}}">{{$option['value']}}</option>
                                                                        @endforeach
                                                                      </select>
                                      </td> 
                                      @endif 
                                    @endif

                                  </tr>
                              @endif
                            <?php next($item_attr);} ?>
                                                          
                          </tbody>
                        </table>
                      </div>
                    <center>
                        @if(Auth::check())
                        <button type='submit' id="find_button" class="btn btn-primary"> Find better item</button>
                        @else
                        {{ HTML::linkAction('AuthenController@getLogin','Login for recommendation',array(), array('class' => 'btn btn-primary')) }}
                        @endif
                      </center>

                    </div>
                </div>
                {{ Form::close() }}
            </div>

            <div class="row _cmt">
            <div class="col-md-10 col-md-offset-2">
            <!-- Comment Part -->
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
 
            </div>
    </div>


<div  class="col-md-3 detail-left">
<div class="_header">Recommended Item</div>
<div class="spinner" hidden>
  <div class="bounce1"></div>
  <div class="bounce2"></div>
  <div class="bounce3"></div>
</div>

  <div id="recommend_list">

  </div>
</div>

  

<script type="text/javascript">
$(function() {

      // this is the id of the form
      // $("#critique").submit(function() {
      //     var url = "{{URL::action('RecommendController@reciveCritique')}}"; 
      //     $.ajax({
      //            type: "POST",
      //            url: url,
      //            data: $("#critique").serialize(), // serializes the form's elements.
      //            error:function(err){
      //             console.log(err);
      //            },
      //            beforeSend:function(){
      //             $("#find_button").html('Finding ...');
      //             $('.spinner').show();
      //             $("#recommend_list").empty();
      //            },
      //            success: function(e)
      //            {
      //               $("#find_button").html('Find better item');
      //               $('.spinner').hide();
      //               $("#recommend_list").empty();
      //               $("#recommend_list").html(e);
      //            }
      //          });
      //     return false; // avoid to execute the actual submit of the form.
      // });

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
            $('.spinner').show();
            $("#recommend_list").empty();
          },
          success: function (e) {
            $('.spinner').hide();
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