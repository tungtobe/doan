

{{   Session::get('message')   }}
<div class="col-md-3">
    {{ Auth::user()->username}}    <br>
    chỗ này để một cái ava tượng trưng ...       
</div>
<div class="col-md-9 well hero-unit">  

<pre>
<b>Admin</b> đã được <b>4</b> người kết bạn
<b>Admin</b> đã được <b>6</b> người chọn làm chuyên gia
<b>Admin</b> đã chọn <b>10</b> người làm chuyên gia của mình




Có 2 trạng thái của nút 
<hr>
Trạng thái 1 khi chưa kết bạn hoặc chưa chọn chuyên gia
    <button id='addfriend'>Add Friend</button>
    <button id='addfriend'>Add Expert</button>

<hr>
Trạng thái 2 khi đã kết bạn và đã chọn chuyên gia
    <button id='addfriend'>Unfriend</button>
    <button id='addfriend'>Remove Expert</button>
</div>

   
</pre>






<script type="text/javascript">
$(function() {
    $("#addfriend").click(function(e){
      $.ajax({
                    url: '{{ URL::action('UserController@addFriend') }} ',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: {{ $user->id }}
                    },
                    error: function(err) {
                        console.log(err);
                    },
                    success: function(res) {
                        console.log(res);                    
                    }
                });
        });


 });
</script>