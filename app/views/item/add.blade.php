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
	@foreach($attributes as $attribute)
	<tr>
		<td>{{Form::label($attribute->attr_name, $attribute->attr_name)}}<td>

		@if($attribute->attr_type == 'Varchar')
		<td>{{Form::text($attribute->id)}}</td>
		@elseif($attribute->attr_type == 'Boolean')
		<td>{{Form::select($attribute->id, array('0' => 'No', '1' => 'Yes'), 'No' )}}</td>
		@else
		<td>{{Form::input('number', $attribute->id)}}</td>
		@endif
	</tr>
	@endforeach
	</table>
	{{Form::submit('Save', array('class' =>'btn btn-primary'))}}
	{{Form::close()}}



