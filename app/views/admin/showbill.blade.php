<div class="container" style="display:table;" >
	<table class="table table-bordered">
			<tr>
				<th>Id</th>
				<th>Created time</th>
				<th>Created by</th>
				<th>Confirm</th>
				<th>Delete</th>
			</tr>
		<tbody>
			<?php foreach ($bills as $bill): ?>
        		<tr>
        			<td><a class="" href="{{ URL::action('AdminController@viewBill', [$bill->id]) }}">
        			{{ $bill->id }}</td>
        			<td>
        				{{$bill->created_at}}
        			</a></td>
        			<td>
        				{{$bill->user}}
        			</td>
        			<td>
        				@if($bill->status == 0)
        				{{ Form::checkbox('name', $bill->id, false, ['class' => 'confirm']); }}
        				@else
        				{{ Form::checkbox('name', $bill->id, true, ['class' => 'confirm']); }}
        				@endif
        			</td>
        			<td>
        				{{ Form::checkbox('name', $bill->id, false, ['class' => 'delete']); }}
        			</td>
        		</tr>
    		<?php endforeach; ?>
		</tbody>
	</table>
</div>
<?php echo $bills->links(); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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

	$('.confirm').change(function() {
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
					a.checked = !a.checked;
				} else {
					location.reload();
				}
			}
		});	
	});
});
</script>

<pre>
Hiển thị thông tin của các đơn hàng theo thứ tự mới nhất (được tạo gần nhất) bằng bảng có phân trang.


Id  |    Thời gian tạo đơn hàng     |    Người tạo    |      Confirm     |     Delete  
-------------------------------------------------------
1     20/4/2015 15:00                user1                      V                X
2     19/4/2015 15:00                user2                      V                X



<< < 1 2 3 > >>

NOTE
Các chức năng có trong mỗi cột
- Confirm đơn hàng (đơn hàng khi được confirm thì người dùng sẽ ko thay đổi được nữa)
- Delete đơn hàng (trước khi delete phải xác nhận lại bằng popup là có delete hay k ?). 
Đơn hàng  bị delete hoàn toàn  (hard delete)
- Click vào đơn hàng thì xem được chi tiết đơn hàng



</pre>