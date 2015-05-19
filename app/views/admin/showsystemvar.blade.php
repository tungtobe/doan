{{ Session::get('message')}}
    <center>
        <div class="row"><h2>Edit System Value</h2></div>
        <br/>
        <div class="row">
            {{ Form::open(array('url' => 'admin/postSysVar', 'method' => 'get')) }}
            Weight for unchange attributes : 
            <input type="number" name="unchange" value="{{$unchange}}">
			<br>
			{{$errors->first('unchange')}}
			<br>
			Weight for changed attributes:
			<input type="number" name="changed" value="{{$changed}}">	
			<br>
			{{$errors->first('changed')}}
			<br>

			<button type="submit" class="btn btn-primary">Set</button>
			{{ Form::close() }}
        </div>
    </center>
