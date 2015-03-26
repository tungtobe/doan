<?php 
class Item extends Eloquent {

  
    protected $table = 'items';

    

    //Define relationship between Item - Value
    public function value() {
        return $this->hasMany('Value', 'item_id');
    }


    public static function validate($input) {
        $rules = array(
            'name' => 'required'
        );
        
        return Validator::make($input, $rules);
    }

}