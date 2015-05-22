 <!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Attribute Manager <small>Add New Attribute </small>
        </h1>
        
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user"></i> Add New Attribute</h3>
            </div>
            <div class="panel-body">
            	{{Form::open(array('action' => array('AdminController@addAttribute'))) }}
            	<h2>{{ Session::get('message')}}</h2>
    			<center>
	            Attribute Name: 
				{{ Form::text('attr_name') }} 
				<br>
				{{$errors->first('attr_name')}}
				<br>
				Attribute Type:
				{{ Form::select('attr_type', array('Varchar' => 'Varchar',
													'Boolean' => 'Boolean',
													'Integer' => 'Integer',
													'Float' => 'Float'
													), 'Varchar') }}
				<br>
				{{$errors->first('attr_type')}}
				<br>

				<button type="submit" class="btn btn-primary">Add</button>
				{{ Form::close() }}
   			</center>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->





	


