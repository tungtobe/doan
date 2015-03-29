<?php

class UserController extends BaseController {

    public function getShow($id) {
        $user = User::find($id);
        $this->layout->content = View::make('user.profile')->with('user' , $user);
        // var_dump($user->username);die;

        
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

    public function addFriend($id){
        $current_user = Auth::user()->id;
        $added_user = $id;

        $rel = new Relationship;
        $rel->user_id = $current_user;
        $rel->rel_user_id = $added_user;
        $rel->rel_type = '1' ;
        $rel->save();

        return Response::json ( array (
                'mes' => 'done'
        ) );
    }
}
