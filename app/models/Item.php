<?php 
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Item extends Eloquent {

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    protected $table = 'items';

    public static function validate($input) {
        $rules = array(
            'name' => 'required'
        );
        
        return Validator::make($input, $rules);
    }

}