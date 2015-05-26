 <!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Order Manager 
        </h1>
        
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user"></i> Order Manager  </h3>
            </div>
            <div class="panel-body">
            	<table class="table table-bordered">
					<tr>
						<th>Id</th>
						<th>Created time</th>
						<th>Created by</th>
						<th>Amount</th>
						<th>Confirm</th>
						<th>Delete</th>
					</tr>
					<tbody>
					<?php foreach ($bills as $bill): ?>
		        		<tr>
		        			<td>{{ $bill->id }}</td>
		        			<td>{{$bill->created_at}}</td>
		        			<td>{{$bill->user}}</td>
		        			<td>{{number_format($bill->amount)}} VND</td>
		        			<td><button class="btn btn-primary confirm" value="{{$bill->id}}">Confirm</button></td>
		        			<td><button class="btn btn-danger delete" value="{{$bill->id}}">Delete</button></td>
		        		</tr>
		    		<?php endforeach; ?>
					</tbody>
				</table>
				<?php echo $bills->links(); ?>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->






<script type="text/javascript">
	$(function(){
	$(".delete").confirm({
			text: "Are you sure you want to delete this bill?",
			title: "Confirmation required",
			confirm: function(button) {
				console.log(this.button[0].value);
				postDelete(this.button[0].value);
			},
			cancel: function(button) {
	        // nothing to do
	    },
	    confirmButton: "Yes I am",
	    cancelButton: "No",
	    post: true,
	    confirmButtonClass: "btn-danger",
	    cancelButtonClass: "btn-default",
	    dialogClass: "modal-dialog modal-lg" // Bootstrap classes for large modal
	});

	function postDelete(id) {
		$.ajax({
			type: "POST",
			url: "{{ URL::action('AdminController@deleteBill') }}",
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

	$('.confirm').click(function() {
		var a = this;
		$.ajax({
			type: "POST",
			url: "{{ URL::action('AdminController@confirmBill') }}",
			data: {
				id: this.value,
			},
			dataType: "json",
			success: function(data) {
				console.log(data);
				if(data != "Success") {
					console.log(data);
				} else {
					location.reload();
				}
			}
		});	
	});
});
</script>

