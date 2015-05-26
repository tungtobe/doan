
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
						<td>{{$item->quantity}}</td>
						<td>{{number_format($item->price)}}</td>
			  		</tr>
			  	<?php endforeach; ?>
			  	<tr>
			  	<td></td>
			  	<td></td>
			  	<td>Total</td>
			  	<td><label class="grandtotal">{{number_format($totalprice)}}</label></td>
		  	</tr>
			</table>   
		</div>
		<a href="{{ URL::action('UserController@editBill', $id) }}" class='btn btn-primary'>Edit Order</a>       
    </div>
</div>
