<div class="hero-unit">
    <center>
        <div class="row"><h2>Sign Up</h2></div>
        <br/>
        <div class="row">
            {{ Form::open(array('url' => 'authen/signup')) }}
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
			{{ Form::submit('Signup') }}
			{{ Form::close() }}
        </div>
    </center>
</div>