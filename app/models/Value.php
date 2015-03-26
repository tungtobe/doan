<?php 
class Value extends Eloquent {

  
    protected $table = 'values';

    

    //Define Inverse Of relationship between Item - Valute
    public function item() {
        return $this->belongsTo('Item', 'item_id');
    }

    //Define Inverse Of relationship between Attribute - Valute
    public function attribute() {
        return $this->belongsTo('Attribute', 'attr_id');
    }
    
    public static function validate($input) {
        $rules = array(
            'value' => 'required'
        );
        
        return Validator::make($input, $rules);
    }

}