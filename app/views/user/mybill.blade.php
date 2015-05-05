<div class="col-md-3">
	{{ Auth::user()->username}}          
</div>
<div class="col-md-9 well hero-unit">  

	<h1 > Manager Bill </h1>
	<hr>
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
<div class="col-md-3"></div>
<div class="col-md-9 well hero-unit">  

	<h1 > Confirmed Bill </h1>
	<hr>
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