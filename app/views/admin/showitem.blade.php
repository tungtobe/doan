
	<center>
		<div class="row"><h2>Item Manager</h2></div>
	</center>
	<table class="table table-bordered">
			<tr>
				<th>Id</th>
				<th>Item</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		<tbody>
			<?php foreach ($items as $item): ?>
        		<tr>
        			<td>{{ $item->id }}</td>
        			<td><a class="" href="{{ URL::action('ItemController@getShow', [$item->id]) }}">
        				{{$item->name}}
        			</a></td>
        			<td>
        				
        			</td>
        			<td>
        				{{ Form::checkbox('name', $item->id, false, ['class' => 'confirm']); }}
        			</td>
        		</tr>
    		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $items->links(); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
$(function() {
	$(".confirm").confirm({
			text: "Are you sure you want to delete this item?",
			title: "Confirmation required",
			confirm: function(button) {
				console.log(this.button[0].value);
				postDeleteItem(this.button[0].value);
			},
			cancel: function(button) {
	        // nothing to do
	    },
	    confirmButton: "Yes I am",
	    cancelButton: "No",
	    post: true,
	    confirmButtonClass: "btn-danger",
	    cancelButtonClass: "btn-default",
	    dialogClass: "modal-dialog modal-lg" // Bootstrap classes for large modal
	});

	function postDeleteItem(id) {
		$.ajax({
			type: "POST",
			url: "{{ URL::action('AdminController@postDeleteItem') }}",
			data: {
				id: id,
			},
			dataType: "json",
			success: function(data) {
				console.log(data);
				if(data != "Success") {
				} else {
					location.reload();
				}
			}
		});	
	}


});
</script>
