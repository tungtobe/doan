<div class="hero-unit">
    <center>
        <div class="row"><h2>Login</h2></div>
        <br/>
        <div class="row">
            {{ Form::open(array('url' => 'authen/login')) }}
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
			{{ Form::submit('Login') }}
			{{ Form::close() }}
        </div>
    </center>
</div>