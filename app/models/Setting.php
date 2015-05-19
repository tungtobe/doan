<?php 
class Setting extends Eloquent {

  
    protected $table = 'Setting';

    
    public static function validate($input) {
        $rules = array(
            'unchange' => ' numeric | required ',
            'changed' => 'numeric | required  '
        );
        
        return Validator::make($input, $rules);
    }

}