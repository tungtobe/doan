	<div class="col-md-3">
         {{ Auth::user()->username}}          
    </div>
    <div class="col-md-9 well hero-unit">  

    	<h1 > Make bill </h1>
		<hr>
		<table id='favoriteTable' class="table table-bordered">
			<tr>
		    	<th>Item </th> 
		    	<th>Price/Product</th>
		    	<th>Amount</th>
		    	<th>Sum</th>
		  	</tr>
		  	<?php foreach ($items as $item): ?>
		  	 	<tr id="row{{$item->id}}">
		  	 		<input type="hidden" value="{{ $item->id }}" class="itemid">
		    		<td><a href="{{ URL::action('ItemController@getShow', $item->id ) }}" title="{{ $item->name }}">{{ $item->name }}</a></td> 
		    		<td>
		    			<label class="price">
		    				@if(isset($items_attr[$item->id]['Price']))
								{{ number_format($items_attr[$item->id]['Price']) }}
							@else
								0
							@endif
						</label>
					</td>
					@if(isset($item['quantity']))
					<td><input name="amount" class="quantity" value="{{$item->quantity}}"></td>
					@else
					<td><input name="amount" class="quantity" value="0"></td>
					@endif
					<td><label name="subtotal" class="subtotal">
						@if(isset($items_attr[$item->id]['Price']))
							{{ number_format($items_attr[$item->id]['Price']) }}
							@else
							0
							@endif
					</label></td>
		  		</tr>
		  	<?php endforeach; ?>
		  	<tr>
		  	<td></td>
		  	<td></td>
		  	<td>Total</td>
		  	<td><label class="grandtotal"></label></td>
		  	</tr>
		</table>   

		<button id='saveBill' class='btn btn-primary'>Save Bill</button>       
    </div>

<script type="text/javascript">
$(function() {
	var is_edit = {{$isEdit}};
	var user_id = {{Auth::user()->id}};
	$('.quantity , .price').each(function() {
        UpdateTotals(this);
		CalculateTotal();
    });

	$('.quantity , .price').on('change', function() {
        UpdateTotals(this);
		CalculateTotal();
    });

	function UpdateTotals(elem) {
		var container = $(elem).parent().parent();
		var quantity = container.find('.quantity').val();
		var price = parseFloat(container.find('.price').text().split(',').join(''));
		var subtotal = parseInt(quantity) * parseFloat(price);
		container.find('.subtotal').text(formatThousands(subtotal));
	}

	function CalculateTotal(){
		var lineTotals = $('.subtotal');
		var quantityTotal = $('.quantity');
		var grandTotal = 0.0;
		$.each(lineTotals, function(i){
			grandTotal += parseFloat($(lineTotals[i]).text().split(',').join('')) ;
		});
		$('.grandtotal').text(formatThousands(grandTotal));
	}

	function formatThousands(n, dp) {
		var s = ''+(Math.floor(n)), d = n % 1, i = s.length, r = '';
		while ( (i -= 3) > 0 ) { r = ',' + s.substr(i, 3) + r; }
		return s.substr(0, i + 3) + r + (d ? '.' + Math.round(d * Math.pow(10,dp||2)) : '');
	}

	$('#saveBill').click(function() {

		CalculateTotal();
		var bill_items = {};
		$('.itemid').each(function() {
			bill_items[$(this).val()] = $(this).parent().find('.quantity').val();
		});

		$.ajax({
			type: "POST",
			dataType: 'json',
			url: " {{ URL::action('UserController@saveBill' ) }} ",
			data: {
				"bill": bill_items,
				"isEdit" : is_edit
			}
		}).done(function(data) {
			window.location.href = '/user/bill/' + user_id;
		}).fail(function(jqXHR, textStatus) {
			return false;
		});
	});

});

</script>