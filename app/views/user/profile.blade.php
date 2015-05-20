

{{   Session::get('message')   }}
<div class="col-md-3">
    <center>
    <img src="https://fbcdn-sphotos-g-a.akamaihd.net/hphotos-ak-xfp1/v/t1.0-9/p720x720/10429261_10203664826198277_3549355919811911397_n.jpg?oh=df78cbab872601999cdde967bbbb5b53&oe=5608BB1F&__gda__=1439119590_b7833ff461a5dcdff613e84486e6bedd" height="230" weight="230">     
    <hr>
    <h3>{{ $user->username}}    </h3>
    </center>
</div>
<div class="col-md-9 well hero-unit">  


<b>{{ $user->username}} </b> has <b>{{ $friends_number}} </b> friend(s) <br>
<b>{{ $user->username}} </b> chose <b>{{ $expert_number}}</b> user(s) as Expert <br>
<b>{{ $user->username}}</b> has been chosen by <b>{{ $follow_number}}</b> user(s) as their Expert<br>

@if(Auth::user()->id != $user->id)
    @if($rel_friend == null)
    <button id='friend' value='0' class='btn btn-primary' style="opacity:0.4;">Add Friend</button>
    @else
    <button id='friend' value='1' class='btn btn-primary' > Friend </button>
    @endif

    @if($rel_expert == null)
    <button id='expert' value='0' class='btn btn-primary' style="opacity:0.4;">Add Expert</button>
    @else
    <button id='expert' value='1' class='btn btn-primary' > Expert </button>
    @endif
@endif



<script type="text/javascript">
$(function() {
    $("#friend").click(function(e){
        var mode = $(this).val();
        $.ajax({
            url: '{{ URL::action('UserController@friend') }} ',
            type: 'POST',
            dataType: 'json',
            data: {
                id: {{ $user->id }},
                mode: mode
            },
            error: function(err) {
                console.log(err);
            },
            success: function(data) {
                if (data.state == 'OK') {
                    $('#friend').val(data.change_mode);
                    if (data.change_mode == 1) {
                        $('#friend').css('opacity','1');
                        $('#friend').html("Friend");
                    }else{
                        $('#friend').css('opacity','0.4');
                        $('#friend').html("Add Friend");
                    };
                    
                    alert(data.mes);
                };
            }
        });  
    });


    $("#expert").click(function(e){
        var mode = $(this).val();
        $.ajax({
            url: '{{ URL::action('UserController@expert') }} ',
            type: 'POST',
            dataType: 'json',
            data: {
                id: {{ $user->id }},
                mode: mode
            },
            error: function(err) {
                console.log(err);
            },
            success: function(data) {
                if (data.state == 'OK') {
                    $('#expert').val(data.change_mode);
                    if (data.change_mode == 1) {
                        $('#expert').css('opacity','1');
                        $('#expert').html("Expert");
                    }else{
                        $('#expert').css('opacity','0.4');
                        $('#expert').html("Make Expert");
                    };
                    
                    alert(data.mes);
                };
            }
        });  
    });
 });
</script>