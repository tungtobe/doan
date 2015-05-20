 <!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            System Manager <small>Edit System Defaul Value </small>
        </h1>
        
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user"></i> System Defaul Value </h3>
            </div>
            <div class="panel-body">
            	{{ Session::get('message')}}
            	<center>
		        
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
            </div>
        </div>
    </div>
</div>
<!-- /.row -->



