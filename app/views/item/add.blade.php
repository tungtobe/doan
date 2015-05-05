<div class="container">
{{Form::open(array('action' => array('AdminController@postAddItem'))) }}
@if ($errors->has())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
        {{ $error }}<br>        
    @endforeach
</div>
@endif	
<div>
{{Form::label('name', 'Name')}}
{{Form::text('name')}}
</div>
<div>
{{Form::label('manufacturer', 'Manufacturer')}}
{{Form::text('manufacturer')}}
</div>
<div>
{{Form::label('img', 'IMG')}}
{{Form::text('img')}}
</div>
<div>
{{Form::label('os', 'OS')}}
{{Form::text('os')}}
</div>
<div>
{{Form::label('cpu', 'CPU')}}
{{Form::text('cpu')}}
</div>
<div>
{{Form::label('gpu', 'GPU')}}
{{Form::text('gpu')}}
</div>
<div>
{{Form::label('screen_type', 'Screen Type')}}
{{Form::text('screen_type')}}
</div>
<div>
{{Form::label('screen_resolution', 'Screen Resolution')}}
{{Form::text('screen_resolution')}}
</div>
<div>
{{Form::label('sim', 'Sim')}}
{{Form::text('sim')}}
</div>
<div>
{{Form::label('battery', 'Battery')}}
{{Form::text('battery')}}
</div>
<div>
{{Form::label('screen_size', 'Screen size')}}
{{Form::text('screen_size')}}
</div>
<div>
{{Form::label('cpu_speed', 'CPU speed')}}
{{Form::text('cpu_speed')}}
</div>
<div>
{{Form::label('ram', 'RAM')}}
{{Form::text('ram')}}
</div>
<div>
{{Form::label('nfc', 'NFC')}}
{{Form::text('nfc')}}
</div>
<div>
{{Form::label('rom', 'ROM')}}
{{Form::text('rom')}}
</div>
<div>
{{Form::label('sd_card', 'SD card')}}
{{Form::text('sd_card')}}
</div>
<div>
{{Form::label('price', 'Price')}}
{{Form::text('price')}}
</div>
<div>
{{Form::label('rear_camera', 'Rear camera')}}
{{Form::text('rear_camera')}}
</div>
<div>
{{Form::label('front_camera', 'Front camera')}}
{{Form::text('front_camera')}}
</div>
<div>
{{Form::label('length', 'Length')}}
{{Form::text('length')}}
</div>
<div>
{{Form::label('width', 'Width')}}
{{Form::text('width')}}
</div>
<div>
{{Form::label('thickness', 'Thickness')}}
{{Form::text('thickness')}}
</div>
<div>
{{Form::label('weight', 'Weight')}}
{{Form::text('weight')}}
</div>

{{Form::submit('Save')}}
{{Form::close()}}
</div>