<?php 
class FavoriteItem extends Eloquent {

  
    protected $table = 'FavoriteItem';

    public function user() {
        return $this->belongsTo('User', 'user_id');
    }


    public function item(){
    	return $this->belongsTo('Item','item_id');
    }


}