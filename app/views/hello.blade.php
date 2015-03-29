<!-- Main hero unit for a primary marketing message or call to action -->

<div class="hero-unit">

    <center><h1>Show First Recommend List</h1></center>

</div>

<div class="container">
	<div class="module-product-list row clearfix 204755f8-887d-44b9-b46c-682a59cea818">
    <?php foreach ($items as $item): ?>
    
        
		    <div class="col-md-3" id="product-item-{{$item->id}}">
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
							{{ $items_attr[$item->id]['Price'] }}
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
		                <span class="rate-good-product"> GOOD </span>   400    
		                <span class="rate-bad-product"> BAD  </span>   280  
		                
		            </div>
		        </div>
		    </div>    
		
    <?php endforeach; ?>
    </div>
</div>







<?php echo $items->links(); ?>

@section('javascript')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>  
<script src="http://malsup.github.com/jquery.form.js"></script>  

@stop