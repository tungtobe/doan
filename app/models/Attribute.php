<?php 
class Attribute extends Eloquent {

  
    protected $table = 'Attribute';

    
    public static function validate($input) {
        $rules = array(
            'attr_name' => 'required',
            'attr_type' => 'required'
        );
        
        return Validator::make($input, $rules);
    }

}