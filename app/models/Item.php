<?php 
class Item extends Eloquent {

  
    protected $table = 'items';

    public static function validate($input) {
        $rules = array(
            'name' => 'required'
        );
        
        return Validator::make($input, $rules);
    }

}