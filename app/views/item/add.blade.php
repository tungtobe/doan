	@if ($errors->has())
	<div class="alert alert-danger">
	    @foreach ($errors->all() as $error)
	        {{ $error }}<br>        
	    @endforeach
	</div>
	@endif	
	<center>
		<div class="row"><h2>Add new Item</h2></div>
	</center>

	{{Form::open(array('action' => array('AdminController@postAddItem'))) }}

	<table class="table table-bordered">
		<tr>
			<td>{{Form::label('name', 'Name *')}}</td>
			<td>{{Form::text('name')}}</td>
		
		</tr>

		<tr>
			<td>{{Form::label('price', 'Price *')}}</td>
			<td>{{Form::input('number', '20')}}</td>
		
		
		</tr>

		<tr>
			<td>{{Form::label('img', 'IMG *')}}</td>
			<td>{{Form::text('6')}}</td>
		
		
		</tr>

		<tr>
			<td>{{Form::label('manufacturer', 'Manufacturer')}}</td>
			<td>{{Form::text('5')}}</td>
		
		</tr>

		<tr>
			<td>{{Form::label('os', 'OS')}}</td>
			<td>{{Form::text('7')}}</td>
		
		
		</tr>

		<tr>
			<td>{{Form::label('cpu', 'CPU')}}</td>
			<td>{{Form::text('8')}}</td>
		</tr>

		<tr>
			<td>{{Form::label('gpu', 'GPU')}}</td>
			<td>{{Form::text('9')}}</td>
		</tr>

		<tr>
			<td>{{Form::label('screen_type', 'Screen Type')}}</td>
			<td>{{Form::text('10')}}</td>
		
		
		</tr>

		<tr>
			<td>{{Form::label('screen_resolution', 'Screen Resolution')}}</td>
			<td>{{Form::text('11')}}</td>
		
		
		</tr>

		<tr>
			<td>{{Form::label('sim', 'Sim')}}</td>
			<td>{{Form::input('number', '12')}}</td>
		
		
		</tr>

		<tr>
			<td>{{Form::label('battery', 'Battery')}}</td>
			<td>{{Form::input('number', '13')}}</td>
		</tr>

		<tr>
			<td>{{Form::label('screen_size', 'Screen size')}}</td>
			<td>{{Form::input('number', '14')}}</td>
		</tr>

		<tr>
			<td>{{Form::label('cpu_speed', 'CPU speed')}}</td>
			<td>{{Form::input('number', '15')}}</td>
		</tr>

		<tr>
			<td>{{Form::label('ram', 'RAM')}}</td>
			<td>{{Form::input('number', '16')}}</td>
		
		
		</tr>

		<tr>
			<td>{{Form::label('nfc', 'NFC')}}</td>
			<td>{{Form::select('17', array(''=>'','0' => 'No', '1' => 'Yes'));}}</td>
		
		
		</tr>

		<tr>
			<td>{{Form::label('rom', 'ROM')}}</td>
			<td>{{Form::input('number', '18')}}</td>
		
		
		</tr>

		<tr>
			<td>{{Form::label('sd_card', 'SD card')}}</td>
			<td>{{Form::input('number', '19')}}</td>
		</tr>


		<tr>
			<td>{{Form::label('rear_camera', 'Rear camera')}}</td>
			<td>{{Form::input('number', '24')}}</td>
		</tr>

		<tr>
			<td>{{Form::label('front_camera', 'Front camera')}}</td>
			<td>{{Form::input('number', '25')}}</td>
		</tr>

		<tr>
			<td>{{Form::label('length', 'Length')}}</td>
			<td>{{Form::input('number', '26')}}</td>
		</tr>

		<tr>
			<td>{{Form::label('width', 'Width')}}</td>
			<td>{{Form::input('number', '27')}}</td>
		</tr>

		<tr>
			<td>{{Form::label('thickness', 'Thickness')}}</td>
			<td>{{Form::input('number', '28')}}</td>
		</tr>

		<tr>
			<td>{{Form::label('weight', 'Weight')}}</td>
			<td>{{Form::input('number', '29')}}</td>
		</tr>

	</table>
	{{Form::submit('Save', array('class' =>'btn btn-primary'))}}
	{{Form::close()}}

