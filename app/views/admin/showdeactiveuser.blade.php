	<center>
		<div class="row"><h2>Banned User Manager</h2></div>
	</center>

	<table class="table table-bordered">
			<tr>
				<th>Username</th>
				<th>User Role </th>
				<th>Unban</th>
			</tr>
		<tbody>
			<?php foreach ($users as $user): ?>
        		<tr>
        			<td>{{$user->username}}</td>
        			<td>
        				@if($user->role == 0) {{"Admin"}}
        				@else {{"User"}}
        				@endif
        			</td>
        			<td>
        				{{ Form::checkbox('name', $user->id, false, ['class' => 'confirm']); }}
        			</td>
        		</tr>
    		<?php endforeach; ?>
		</tbody>
	</table>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
	$(".confirm").confirm({
			text: "Are you sure you want to unban this user?",
			title: "Confirmation required",
			confirm: function(button) {
				postBan(this.button[0].value);
			},
			cancel: function(button) {
	        // nothing to do
	    },
	    confirmButton: "Yes I am",
	    cancelButton: "No",
	    post: true,
	    confirmButtonClass: "btn-danger",
	    cancelButtonClass: "btn-default",
	    dialogClass: "modal-dialog modal-md" 
	});

	function postBan(id) {
		$.ajax({
			type: "POST",
			url: "{{ URL::action('AdminController@postBanUser') }}",
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

