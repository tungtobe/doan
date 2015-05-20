
@if ($errors->has())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
        {{ $error }}<br>        
    @endforeach
</div>
@endif

<h1>{{$item->name}}</h1>
	{{Form::open(array('action' => array('AdminController@postEditItem', $item->id))) }}
	<table class="table table-bordered">
	@foreach($attributes as $attribute)
	@if(isset($attr[$attribute->id]))
	<?php $value = $attr[$attribute->id]; ?>
	@else
	<?php $value = null;  ?>
	@endif
	<tr>
		<td>{{Form::label($attribute->attr_name, $attribute->attr_name)}}<td>

		@if($attribute->attr_type == 'Varchar')
		<td>{{Form::text($attribute->id, $value )}}</td>
		@elseif($attribute->attr_type == 'Boolean')
			@if($attribute->value == 0)
			<td>{{Form::select($attribute->id, array('0' => 'No', '1' => 'Yes') , 'No' ) }}</td>
			@else($attribute->value == 1)
			<td>{{Form::select($attribute->id, array('0' => 'No', '1' => 'Yes') , 'Yes' ) }}</td>
			@endif
		@else
		<td>{{Form::input('number', $attribute->id, $value)}}</td>
		@endif
	</tr>
	@endforeach
	</table>
	{{Form::submit('Save', array('class' =>'btn btn-primary'))}}
	{{Form::close()}}


