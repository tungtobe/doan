
<div class="col-md-3">
    <center>
    <img src="https://fbcdn-sphotos-g-a.akamaihd.net/hphotos-ak-xfp1/v/t1.0-9/p720x720/10429261_10203664826198277_3549355919811911397_n.jpg?oh=df78cbab872601999cdde967bbbb5b53&oe=5608BB1F&__gda__=1439119590_b7833ff461a5dcdff613e84486e6bedd" height="230" weight="230">     
    <hr>
    <h3>{{ Auth::user()->username}}    </h3>
    </center>
</div>

    <div class="col-md-9 well hero-unit">  
    {{ Form::open(array('url' => 'user/makebill')) }}
    	<h1 > Favorite </h1>
		<hr>
		<table id='favoriteTable' class="table table-bordered">
			<tr>
		    	<th>#</th>
		    	<th>Item </th> 
		    	<th>Price</th>
		    	<th>Remove</th>
		  	</tr>
		  	 <?php foreach ($favorite_items as $item): ?>
		  	 	<tr id="row{{$item->id}}">
		   			<td><input type="checkbox" name="chk[]" value="{{$item->id}}"></td>
		    		<td><a href="{{ URL::action('ItemController@getShow', $item->id ) }}" title="{{ $item->name }}">{{ $item->name }}</a></td> 
		    		<td>
		    			@if(isset($favorite_items_attr[$item->id]['Price']))
							{{ number_format($favorite_items_attr[$item->id]['Price']) }}
							@else
							0
							@endif
					</td>
					<td><button class='btn btn-danger btn-del' data-item='{{$item->id}}' >Remove</button></td>
		  		</tr>
		  	<?php endforeach; ?>
		  	
		</table>   

		<button id='makeBill' class='btn btn-primary' disabled>Make Bill</button>  
        {{ Form::close() }}
    </div>


<!-- Modal Confirm Delete-->
<div class="modal fade modal-confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">WARNING</h4>
            </div>
            <div class="modal-body">
                <p>Do you realy want to remove this item from your favorite？</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-modal-ok">OK</button>
                <button type="button" class="btn btn-modal-cancel btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
$(function(){
	$('.btn-del').click(function(event) {
            if (event.preventDefault != null) {
                event.preventDefault();
            }
            $('.modal-confirm').modal();
            var item_id = $(this).attr('data-item');


            $('.btn-modal-ok').click(function(event) {
                if (event.preventDefault != null) {
                    event.preventDefault();
                }

                var modal = $('.modal-confirm');

                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: " {{ URL::action('UserController@removeFromFavorite') }} ",
                    data: {item_id: item_id}
                }).done(function(data) {
                    modal.modal('hide');
                    if (data.mes === 'OK') {
                        $("#row"+item_id).hide();
                    } else {
                        alert(data.mes);
                    }
                }).fail(function(jqXHR, textStatus) {
                    modal.modal('hide');
                });

                return false;
            });

            return false;
        });
	
	$(':checkbox').change(function(){
		var atLeastOneIsChecked = $('#favoriteTable :checkbox:checked').length > 0;
		if (atLeastOneIsChecked) {
			$('#makeBill').removeAttr('disabled');
		}else{
			$('#makeBill').attr('disabled','disabled');
		}
	});	
});
	
</script>

