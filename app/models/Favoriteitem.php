<?php 
class FavoriteItem extends Eloquent {

  
    protected $table = 'favoriteitems';

    

    //Define invert of relationship between Favorite - FavoriteItem
    public function value() {
        return $this->belongsTo('Favorite', 'favorite_id');
    }


    public function item(){
    	return $this->belongsTo('Item','item_id');
    }

}