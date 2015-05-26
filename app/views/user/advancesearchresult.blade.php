@if(is_null($status))
    <center><h2> Item Not Found </h2></center>
@else
    @foreach ($items as $item)
        <div class="col-md-3 product-item-1">
            <div class="product-item">
                            <div class="pro-img">
                                <a class="pu-image" href="{{ URL::action('ItemController@getShow', $item->id ) }}" data-images="{{ $items_attr[$item->id]['IMG'] }}">
                                    <span class="vertical-align-helper"></span>
                                    <img alt="{{ $item->name }}" class="product-image" src="{{ $items_attr[$item->id]['IMG'] }}">
                                </a>
                            </div>
                            <div class="clearfix  product-price-info">
                                <span class="product-price">
                                    @if(isset($items_attr[$item->id]['Price']))
                                    {{ number_format($items_attr[$item->id]['Price']) }}
                                    @else
                                    0
                                    @endif
                                </span>
                                <span class="product-old-price">
                                </span>
                            </div>
                            <div class="product-tile">
                                <a href="{{ URL::action('ItemController@getShow', $item->id ) }}" title="{{ $item->name }}">{{ $item->name }}</a>
                            </div>

                            <div class="product-service clearfix">
                                <span class="rate-good-product"> GOOD </span> {{$items_vote_arr[$item->id]['good']}}      
                                <span class="rate-bad-product"> BAD  </span>   {{$items_vote_arr[$item->id]['bad']}}  

                            </div>
                        </div>
                    </div>
    @endforeach
@endif

