<?php 
class Favorite extends Eloquent {

  
    protected $table = 'favorites';

    

    //Define relationship between Favorite - FavoriteItem
    public function value() {
        return $this->hasMany('FavoriteItem', 'favorite_id');
    }

    public function user(){
        return $this->belongsTo('User','user_id')
    }
}