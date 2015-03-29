<?php 
class Value extends Eloquent {

  
    protected $table = 'values';
    
    public static function validate($input) {
        $rules = array(
            'value' => 'required'
        );
        
        return Validator::make($input, $rules);
    }

}