 <!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Bill Manager 
        </h1>
        
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user"></i> Confirmed Bill  </h3>
            </div>
            <div class="panel-body">
            	<table class="table table-bordered">
					<tr>
						<th>Id</th>
						<th>Created time</th>
						<th>Created by</th>
						<th>Amount</th>
						<th>Confirm time</th>
					</tr>
					<tbody>
					<?php foreach ($bills as $bill): ?>
		        		<tr>
		        			<td>{{ $bill->id }}</td>
		        			<td>{{$bill->created_at}}</td>
		        			<td>{{$bill->user}}</td>
		        			<td>{{number_format($bill->amount)}} VND</td>
		        			<td>{{$bill->updated_at}}</td>
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





