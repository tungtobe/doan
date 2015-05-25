<?php 
class ValueRange extends Eloquent {

  
    protected $table = 'ValueRange';

    
    public static function validate($input) {
        $rules = array(
            'attr_id' => 'required',
            'value_range' => ' numeric'
        );
        
        return Validator::make($input, $rules);
    }

}