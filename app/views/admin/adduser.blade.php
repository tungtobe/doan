{{ Session::get('message')}}
    <center>
        <div class="row"><h2>Add User</h2></div>
        <br/>
        <div class="row">
            {{ Form::open(array('url' => 'admin/adduser')) }}
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
        </div>
    </center>
