 <!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Item Manager <small>Edit Item </small>
        </h1>
        
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user"></i> Edit Item</h3>
            </div>
            <div class="panel-body">
            	@if ($errors->has())
				<div class="alert alert-danger">
				    @foreach ($errors->all() as $error)
				        {{ $error }}<br>        
				    @endforeach
				</div>
				@endif

				<center>
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

				</center>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->





	








