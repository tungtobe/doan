 {{ HTML::script('js/jquery.confirm.min.js'); }}
 <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            User Manager <small>User List</small>
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-user"></i> User List</h3>
                            </div>
                            <div class="panel-body">
                            	<table class="table table-bordered table-hover table-striped">
                            		<tr>
										<th style="width:40%;">Username</th>
										<th style="width:30%;">User Role </th>
										<th style="width:15%;">Admin</th>
										<th style="width:15%;">Ban</th>
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
						        				@if($user->id != Auth::user()->id)
							        				@if($user->role == 0) 
							        				<button class="cb_make_admin btn btn-primary" value="{{$user->id}}">Remove Admin</button>
							        				@else 
							        				<button class="cb_make_admin btn btn-primary" value="{{$user->id}}">Make Admin</button>
							        				@endif
							        			@endif
						        			</td>
						        			<td>
						        				<button class="confirm btn btn-warning" value="{{$user->id}}">Ban</button>
						        			</td>
						        		</tr>
						    		<?php endforeach; ?>
								</tbody>
                            	</table>
                            	<?php echo $users->links(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->


<script type="text/javascript">
$(function(){
	$('.cb_make_admin').click(function() {
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
				if(data == "Success") {
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

