 <!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            User Manager <small>Banned User List </small>
        </h1>
        
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user"></i> Banned User Manager</h3>
            </div>
            <div class="panel-body">
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
            </div>
        </div>
    </div>
</div>
<!-- /.row -->




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

