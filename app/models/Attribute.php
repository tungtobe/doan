<?php 
class Attribute extends Eloquent {

  
    protected $table = 'attributes';

    

    //Define relationship between Attribute - Valute
    public function values() {
        return $this->hasMany('Value', 'attr_id');
    }
    
    public static function validate($input) {
        $rules = array(
            'attr_name' => 'required',
            'attr_type' => 'required'
        );
        
        return Validator::make($input, $rules);
    }

}