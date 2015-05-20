	<center>
		<div class="row"><h2>User Manager</h2></div>
	</center>	

	<table class="table table-bordered">
			<tr>
				<th>Username</th>
				<th>User Role </th>
				<th>Admin</th>
				<th>Ban</th>
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
        				@if($user->role == 0) {{ Form::checkbox('name', $user->id, true, ['class' => 'cb_make_admin']); }}
        				@else {{ Form::checkbox('name', $user->id, false, ['class' => 'cb_make_admin']); }}
        				@endif
        			</td>
        			<td>
        				{{ Form::checkbox('name', $user->id, false, ['class' => 'confirm']); }}
        			</td>
        		</tr>
    		<?php endforeach; ?>
		</tbody>
	</table>

<?php echo $users->links(); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
	$('.cb_make_admin').change(function() {
		var a = this;
		$.ajax({
			type: "POST",
			url: "{{ URL::action('AdminController@changeAdminPermission') }}",
			data: {
				id: this.value,
			},
			dataType: "json",
			success: function(data) {
				console.log(data);
				if(data != "Success") {
					a.checked = !a.checked;
				} else {
					location.reload();
				}
			}
		});	
	});

	$(".confirm").confirm({
			text: "Are you sure you want to ban this user?",
			title: "Confirmation required",
			confirm: function(button) {
				console.log(this.button[0].value);
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

