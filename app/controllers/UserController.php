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
        if (!Auth::check()) {
            return Redirect::to(URL::action('HomeController@showWelcome'));
        }else{
            $favorite_items = Favoriteitem::where('user_id',$user_id)->get();
            $items = array();
            foreach ($favorite_items as $favorite_item) {
                $item = Item::find($favorite_item->item_id);
                array_push($items, $item);
            }
            $favorite_items_attr = $this->getItemAttributes($items);
            $this->layout->content = View::make('user.favorite')->with(array('favorite_items' => $items ,
                                                                            'favorite_items_attr' => $favorite_items_attr
                                                                                ));
        }
    }

    public function removeFromFavorite(){
        $user_id = Auth::user()->id;
        $item_id = Input::get('item_id');
        if (!Auth::check()) {
            return Response::json(array (
                'mes' => 'Login has been expire, please login again for this function !!!'
            ));
        }

        $favorite_item = Favoriteitem::where(array(
                'user_id' => $user_id,
                'item_id' => $item_id
            ))->first();
        if (is_null($favorite_item)) {
            return Response::json(array (
                'mes' => 'Item isnot in your favorite '
            ));
        }else{
            $favorite_item->delete();
            return Response::json(array (
                'mes' => 'OK'
            ));
        }
    }

    public function getBill($user_id){

    }

    public function makeBill(){
        $items_id = Input::get('items_id');
        return var_dump($items_id);
    }

    public function getFriends($user_id){

    }

    public function addFriend(){
        $current_user = Auth::user()->id;
        $added_user = Input::get('id');

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
