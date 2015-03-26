<?php

class Vote extends Eloquent {

    protected $table = 'votes';



    //Define relationship between Vote-User
    public function user() {
        return $this->belongsTo('User', 'user_id');
    }

}

?>