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
                <!-- <div class="product-shop-info pull-right">
                        <div class="block-top-right">
                            <div class="module-shop-info fade-line-divide">
                                <span class="block-top-right-title fading-text">
                                    Cung cấp bởi
                                </span>
                                    <img src="/Themes/Stores/Default/Styles/Images/V4.0/medal-48.png" class="img-medal">
                                <a class="shop-name" href="/megaplaza" rel="nofollow">megaplaza</a>
                                <span class="shop-address">KM14, xã Ngọc Hồi</span>
                                


                                <div class="reputation-rating reputation-store" data-store-alias="megaplaza">
                                    <a href="javascript:void(0)" style="display: inline-block; font-size: 0px;">
                                        <div>
                                            <span class="repu-rate-point">
                                                
                                                    <img alt="1" src="/Scripts/raty-2.7.0/images/star-off.png">
                                                    <img alt="1" src="/Scripts/raty-2.7.0/images/star-off.png">
                                                    <img alt="1" src="/Scripts/raty-2.7.0/images/star-off.png">
                                                    <img alt="1" src="/Scripts/raty-2.7.0/images/star-off.png">
                                                    <img alt="1" src="/Scripts/raty-2.7.0/images/star-off.png">
                                            </span>
                                            <span class="toggle-view-repu"><i style="vertical-align: top; line-height: 9px; font-size: 9px;" class="fa fa-caret-down"></i></span>
                                        </div>
                                    </a>
                                </div>
                                
                                
                                <br>
                                <div class="clearfix active-date">
                                    <span class="pull-left">Hoạt động từ 01/2014</span>
                                        <a class="pull-right" href="/megaplaza/fpt-f83-4gb-black-1609655.html" target="_blank" rel="nofollow">Xem gian hàng »</a>
                                </div>

                            </div>
                            <div class="module-shop-extra-info">
                                <span class="block-top-right-title fading-text title">
                                    Liên hệ
                                </span>
                                <div class="line-support mobile-support clearfix">
                                    <i class="icon-support icon-phone pull-left sprite sprite-phone-14"></i>
                                    <a class="ellipsis pull-left" href="tel:0934506286" title="0934506286">0934506286</a>
                                </div>
                                    <div class="line-support chat-support clearfix">
                                        <i class="icon-support icon-yh pull-left"></i>
                                        <ul class="u0 pull-left">
                                                <li class="clearfix">
                                                    <a title="" href="ymsgr:sendim?chien.vietmy&amp;m=Xin%20ch%C3%A0o" class="icon pull-left">
                                                        <img src="http://opi.yahoo.com/online?u=chien.vietmy&amp;m=g&amp;t=5&amp;l=us" alt="yahoo">
                                                    </a>
                                                    <a href="ymsgr:sendim?chien.vietmy&amp;m=Xin%20ch%C3%A0o" class="name ellipsis pull-left">Mr Chiến</a>
                                                </li>
                                        </ul>
                                    </div>
                                                                <div class="line-support chat-support clearfix">
                                        <i class="icon-support icon-sk pull-left"></i>
                                        <ul class="u0 pull-left">
                                                <li class="clearfix">
                                                    <a title="Hỗ trợ skype" href="skype:chien.vietmy.com?chat" class="icon pull-left">
                                                        <img src="/Content/Images/icons/skype1.png" alt="">
                                                    </a>
                                                    <a href="skype:chien.vietmy.com?chat" class="name ellipsis pull-left">Kinh Doanh</a>
                                                </li>
                                        </ul>
                                    </div>
                                                                <div class="line-support email-support clearfix">
                                        <i class="sprite sprite-message-12 icon-support icon-email pull-left"></i>

                                        <script type="text/javascript">
                                            var email = base64.decode('Y3NraC5tZWdhcGxhemFAZ21haWwuY29t');
                                            document.write("<a class='ellipsis pull-left' title='" + email + "' href='mailto:" + email + "'>" + email + "</a>");
                                        </script><a class="ellipsis pull-left" title="cskh.megaplaza@gmail.com" href="mailto:cskh.megaplaza@gmail.com">cskh.megaplaza@gmail.com</a>
                                    </div>
                            </div>
                        </div>
                </div> -->
            </div>
        </div>
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
});
</script>