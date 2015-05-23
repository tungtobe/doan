<div class="container _container">
<div class="col-md-3 _ava">
    <center>
    <img src="https://fbcdn-sphotos-g-a.akamaihd.net/hphotos-ak-xfp1/v/t1.0-9/p720x720/10429261_10203664826198277_3549355919811911397_n.jpg?oh=df78cbab872601999cdde967bbbb5b53&oe=5608BB1F&__gda__=1439119590_b7833ff461a5dcdff613e84486e6bedd" height="230" weight="230">     
    <hr>
    <h3>{{ Auth::user()->username}}    </h3>
    </center>
</div>

<div class="col-md-9 well _well">  

	<h3> Manager Bill </h3>
	<div class="_wrap-table">
	<table id='favoriteTable' class="table table-bordered">
		<tr>
			<th>ID </th> 
			<th>Created Time</th>
			<th>Updated Time</th>
			<th>Total Price</th>
			<th>Delete</th>
			<th>Edit</th>
		</tr>
		<?php foreach ($manager_bills as $bill): ?>
		<tr>
			<td>{{ $bill->id }}</td>
			<td>{{ $bill->created_at }}</td>
			<td>{{ $bill->updated_at }}</td>
			<td>{{ number_format($bill->totalprice) }}</td>
			<td><button name="delete" value="{{ $bill->id }}" class="btn btn-danger" >Delete</button></td>
			<td><button name="edit" onclick="window.location='{{ url('user/editbill', $bill->id); }}'" class="btn btn-info">Edit</button></td>
		</tr>
		<?php endforeach; ?>
	</table>   
</div>
</div>
<div class="col-md-3"></div>
<div class="col-md-9 well _well">  

	<h3> Confirmed Bill </h3>
	<div class="_wrap-table">
	<table id='favoriteTable' class="table table-bordered">
		<tr>
			<th>ID</th> 
			<th>Confirmed Time</th>
			<th>Total Price</th>
		</tr>
		<?php foreach ($confirmed_bills as $bill): ?>
		<tr>
			<td>{{ $bill->id }}</td>
			<td>{{ $bill->updated_at }}</td>
			<td>{{ number_format($bill->totalprice) }}</td>
		</tr>
		<?php endforeach; ?>
	</table>   
</div>
</div>
</div>
<script type="text/javascript">
$(function(){
	$('button[name=delete]').on('click', function() {
		var id = $(this).val();
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: " {{ URL::action('UserController@deleteBill' ) }} ",
			data: {"id": id}
		}).done(function(data) {
			location.reload();
		}).fail(function(jqXHR, textStatus) {
			return false;
		});
	});


});
</script>