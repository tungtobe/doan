<div class="container">
{{Form::open(array('action' => array('AdminController@postEditItem', $item_id))) }}
@if ($errors->has())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
        {{ $error }}<br>        
    @endforeach
</div>
@endif	
<div>
{{Form::label('name', 'Name')}}
@if(isset($attr['Name']))
{{Form::text('name', $attr['Name'])}}
@else
{{Form::text('name')}}
@endif
</div>
<div>
{{Form::label('manufacturer', 'Manufacturer')}}
@if(isset($attr['Manufacturer']))
{{Form::text('manufacturer', $attr['Manufacturer'])}}
@else
{{Form::text('manufacturer')}}
@endif
</div>
<div>
{{Form::label('img', 'IMG')}}
@if(isset($attr['IMG']))
{{Form::text('img', $attr['IMG'])}}
@else
{{Form::text('img')}}
@endif
</div>
<div>
{{Form::label('os', 'OS')}}
@if(isset($attr['OS']))
{{Form::text('os', $attr['OS'])}}
@else
{{Form::text('os')}}
@endif
</div>
<div>
{{Form::label('cpu', 'CPU')}}
@if(isset($attr['CPU']))
{{Form::text('cpu', $attr['CPU'])}}
@else
{{Form::text('cpu')}}
@endif
</div>
<div>
{{Form::label('gpu', 'GPU')}}
@if(isset($attr['GPU']))
{{Form::text('gpu', $attr['GPU'])}}
@else
{{Form::text('gpu')}}
@endif
</div>
<div>
{{Form::label('screen_type', 'Screen Type')}}
@if(isset($attr['Screen type']))
{{Form::text('screen_type', $attr['Screen type'])}}
@else
{{Form::text('screen_type')}}
@endif
</div>
<div>
{{Form::label('screen_resolution', 'Screen Resolution')}}
@if(isset($attr['Screen resolution']))
{{Form::text('screen_resolution', $attr['Screen resolution'])}}
@else
{{Form::text('screen_resolution')}}
@endif
</div>
<div>
{{Form::label('sim', 'Sim')}}
@if(isset($attr['Sim']))
{{Form::text('sim', $attr['Sim'])}}
@else
{{Form::text('sim')}}
@endif
</div>
<div>
{{Form::label('battery', 'Battery')}}
@if(isset($attr['Battery']))
{{Form::text('battery', $attr['Battery'])}}
@else
{{Form::text('battery')}}
@endif
</div>
<div>
{{Form::label('screen_size', 'Screen size')}}
@if(isset($attr['Screen size']))
{{Form::text('screen_size', $attr['Screen size'])}}
@else
{{Form::text('screen_size')}}
@endif
</div>
<div>
{{Form::label('cpu_speed', 'CPU speed')}}
@if(isset($attr['CPU speed']))
{{Form::text('cpu_speed', $attr['CPU speed'])}}
@else
{{Form::text('cpu_speed')}}
@endif
</div>
<div>
{{Form::label('ram', 'RAM')}}
@if(isset($attr['Ram']))
{{Form::text('ram', $attr['Ram'])}}
@else
{{Form::text('ram')}}
@endif
</div>
<div>
{{Form::label('nfc', 'NFC')}}
@if(isset($attr['NFC']))
{{Form::text('nfc', $attr['NFC'])}}
@else
{{Form::text('nfc')}}
@endif
</div>
<div>
{{Form::label('rom', 'ROM')}}
@if(isset($attr['ROM']))
{{Form::text('rom', $attr['ROM'])}}
@else
{{Form::text('rom')}}
@endif
</div>
<div>
{{Form::label('sd_card', 'SD card')}}
@if(isset($attr['SD card']))
{{Form::text('sd_card', $attr['SD card'])}}
@else
{{Form::text('sd_card')}}
@endif
</div>
<div>
{{Form::label('price', 'Price')}}
@if(isset($attr['Price']))
{{Form::text('price', $attr['Price'])}}
@else
{{Form::text('price')}}
@endif
</div>
<div>
{{Form::label('rear_camera', 'Rear camera')}}
@if(isset($attr['Rear camera']))
{{Form::text('rear_camera', $attr['Rear camera'])}}
@else
{{Form::text('rear_camera')}}
@endif
</div>
<div>
{{Form::label('front_camera', 'Front camera')}}
@if(isset($attr['Front camera']))
{{Form::text('front_camera', $attr['Front camera'])}}
@else
{{Form::text('front_camera')}}
@endif
</div>
<div>
{{Form::label('length', 'Length')}}
@if(isset($attr['Length']))
{{Form::text('length', $attr['Length'])}}
@else
{{Form::text('length')}}
@endif
</div>
<div>
{{Form::label('width', 'Width')}}
@if(isset($attr['Width']))
{{Form::text('width', $attr['Width'])}}
@else
{{Form::text('width')}}
@endif
</div>
<div>
{{Form::label('thickness', 'Thickness')}}
@if(isset($attr['Thickness']))
{{Form::text('thickness', $attr['Thickness'])}}
@else
{{Form::text('thickness')}}
@endif
</div>
<div>
{{Form::label('weight', 'Weight')}}
@if(isset($attr['Weight']))
{{Form::text('weight', $attr['Weight'])}}
@else
{{Form::text('weight')}}
@endif
</div>

{{Form::submit('Save')}}
{{Form::close()}}
</div>