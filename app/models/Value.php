<?php 
class Value extends Eloquent {

  
    protected $table = 'Value';
    
    public static function validate($input) {
        $rules = array(
            'value' => 'required'
        );
        
        return Validator::make($input, $rules);
    }

}