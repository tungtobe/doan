
<div class="container _container">
	<div class="col-md-3 _ava">
	    <center>
	    <img src="https://fbcdn-sphotos-g-a.akamaihd.net/hphotos-ak-xfp1/v/t1.0-9/p720x720/10429261_10203664826198277_3549355919811911397_n.jpg?oh=df78cbab872601999cdde967bbbb5b53&oe=5608BB1F&__gda__=1439119590_b7833ff461a5dcdff613e84486e6bedd" height="230" weight="230">     
	    <hr>
	    <h3>{{ Auth::user()->username}}    </h3>
	    </center>
	</div>
    <div class="col-md-9 well _well">  
    	<h3> Order </h3>
		<div class="_wrap-table">
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
						<td><input type="number" min="1" name="amount" class="quantity" value="{{$item->quantity}}"></td>
						@else
						<td><input type="number" min="1" name="amount" class="quantity" value="1"></td>
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
		</div>
		<button id='saveBill' class='btn btn-primary'>Save Order</button>       
    </div>
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
		var user_id = {{Auth::user()->id}};
		var flag = true;
		CalculateTotal();
		var bill_items = {};
		$('.itemid').each(function() {
			var quantity = $(this).parent().find('.quantity').val();
			if (quantity <= 0 || !$.isNumeric(quantity)) {
				alert ('Invalid Amount Format Number (MIN 1) ');
				flag = false;
				return false;
			}else{
				bill_items[$(this).val()] = quantity;
			}
		});
		if (flag) {
			saveBill(bill_items);
		};
	});

	function saveBill(bill_items){
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: " {{ URL::action('UserController@saveBill' ) }} ",
			data: {
				"bill": bill_items,
				"isEdit" : is_edit
			}
		}).done(function(data) {
			window.location.href = " {{ URL::action('UserController@getBill', Auth::user()->id ) }} ";
		}).fail(function(jqXHR, textStatus) {
			return false;
		});
	}

});

</script>