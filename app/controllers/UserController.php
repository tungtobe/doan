<?php

class UserController extends BaseController {

    public function getShow($id) {
        $users = User::where('id', $id)->get();
        $user = $users[0];

        
    }

    public function addUser(){
        if (Auth::check()) {
            return Redirect::to(URL::action('HomeController@showWelcome'));
        }elseif (Auth::user()->role != 0) {
            return Redirect::to(URL::action('HomeController@showWelcome'));
        }
    }

    public function getFavorite($user_id){

    }

    public function getBill($user_id){

    }

    public function getFriends($user_id){

    }
}
