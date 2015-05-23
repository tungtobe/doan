
 <!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Attribute Manager 
        </h1>
        
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user"></i> Attribute Manager  </h3>
            </div>
            <div class="panel-body">
			<table class="table table-bordered">
					<tr>
						<th style="width:50%;">Attribute</th>
						<th>Type</th>
						<th style="width:10%;">Edit</th>
						<th style="width:10%;">Delete</th>
					</tr>
				<tbody>
					<?php foreach ($attributes as $attribute): ?>
		        		<tr>
		        			<td style="width:160px;">{{$attribute->attr_name}}</td>
		        			<td> {{$attribute->attr_type}}</td>
		        			<td>
		        				{{ HTML::linkAction('AdminController@postEditAttribute', 'Edit' , $attribute->id , array('class' => 'btn btn-primary')) }}
		        			</td>
		        			<td>
		        				<button class='confirm btn btn-danger' value='{{$attribute->id}}'>Delete</button>
		        			</td>
		        		</tr>
		    		<?php endforeach; ?>
				</tbody>
			</table>
			<?php echo $attributes->links(); ?>
			</div>
        </div>
    </div>
</div>
<!-- /.row -->

<script type="text/javascript">
$(function() {
	$(".confirm").confirm({
			text: "Are you sure you want to delete this attribute?",
			title: "Confirmation required",
			confirm: function(button) {
				console.log(this.button[0].value);
				postDeleteAttribute(this.button[0].value);
			},
			cancel: function(button) {
	        // nothing to do
	    },
	    confirmButton: "Yes I am",
	    cancelButton: "No",
	    post: true,
	    confirmButtonClass: "btn-danger",
	    cancelButtonClass: "btn-default",
	    dialogClass: "modal-dialog modal-md" 
	});

	function postDeleteAttribute(id) {
		$.ajax({
			type: "POST",
			url: "{{ URL::action('AdminController@postDeleteAttribute') }}",
			data: {
				id: id,
			},
			dataType: "json",
			success: function(data) {
				console.log(data);
				if(data != "Success") {
				} else {
					location.reload();
				}
			}
		});	
	}


});
</script>
