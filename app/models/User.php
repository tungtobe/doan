<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait,
        RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'User';

    

    //Define relationship between User-Comments
    public function comment() {
        return $this->hasMany('Comment', 'user_id');
    }

    //Define relationship between User-Votes
    public function vote() {
        return $this->hasMany('Vote', 'user_id');
    }
    

    //Define relationship between User-Bill
    public function bill() {
        return $this->hasMany('Bill', 'user_id');
    }


    //Define relationship between User-Favorite
    public function favoriteitems() {
        return $this->hasMany('Favoriteitem', 'user_id');
    }


    public static function validate($input) {
        $rules = array(
            'username' => 'required',
            'password' => 'required'
        );
        
        return Validator::make($input, $rules);
    }

}
