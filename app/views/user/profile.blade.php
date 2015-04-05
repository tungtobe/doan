

{{   Session::get('message')   }}

<div class="hero-unit">
    <center><h3 class="_title">{{$user->username}}</h3></center>

<button id='addfriend'>Addfriend</button>
</div>


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