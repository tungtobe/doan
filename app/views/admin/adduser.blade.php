 <!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            User Manager <small>Add New User </small>
        </h1>
        
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user"></i> Add New User</h3>
            </div>
            <div class="panel-body">
            	{{ Session::get('message')}}
    			<center>
	            Username: 
				{{ Form::text('username') }} 
				<br>
				{{$errors->first('username')}}
				<br>
				Password:
				{{ Form::password('password') }}
				<br>
				{{$errors->first('password')}}
				<br>
				Role:
				{{ Form::select('role', array('1' => 'User', '0' => 'Admin'), '1') }}
				<br><br>

				<button type="submit" class="btn btn-primary">Add</button>
				{{ Form::close() }}
   			</center>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->


