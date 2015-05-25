<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Attribute Manager <small>Edit Attribute Range </small>
        </h1>
        
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user"></i> Edit Attribute Range</h3>
            </div>
            <div class="panel-body">
            <center>
                <h3>{{$attribute->attr_name}}</h3>

            	{{Form::open(array('action' => array('AdminController@editAttrRange', $id))) }}
                <input type="hidden" name="id" value="{{$id}}" > 
            	@for($i = 0; $i < 10; $i++)
                    <?php 
                    if (isset($attr_ranges[$i])) {
                        $value= $attr_ranges[$i]->value_range;
                    }else{
                        $value = "";
                    }
                    ?>
                
        			Default Recommend Value {{$i + 1}}: 
    	            <input type="number" name="range[{{$i}}]" step="any"  value="{{$value}}">
                    <br><br>
                @endfor
                <h4>{{ Session::get('message')}}</h4>
				<button type="submit" class="btn btn-primary">Save</button>
				{{ Form::close() }}
   			</center>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->