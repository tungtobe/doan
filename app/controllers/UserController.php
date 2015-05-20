<?php

class UserController extends BaseController {

    public function getShow($id) {

        $user = User::find($id);
        if ($user == null) {
            return Redirect::to(URL::action('HomeController@showWelcome'));
        }

        $friends_number = Relationship::where(array('user_id'=> $id , 'rel_type' => '1'))->orWhere(array('rel_user_id'=> $id , 'rel_type' => '1'))->count();
        $expert_number = Relationship::where(array('user_id'=> $id , 'rel_type' => '2'))->count();
        $follow_number = Relationship::where(array('rel_user_id'=> $id , 'rel_type' => '2'))->count();

        if (Auth::user()->id != $user->id) {
            $friend_relationship = Relationship::where(array('user_id'=> $id , 'rel_user_id' => Auth::user()->id, 'rel_type' => '1'))->orWhere(array( 'user_id' => Auth::user()->id, 'rel_user_id'=> $id , 'rel_type' => '1'))->get();
            if ($friend_relationship->count() == 0) {
                 $rel_friend = null;
            }else{
                $rel_friend = "friend";
            }

            $expert_relationship = Relationship::where(array('user_id' => Auth::user()->id , 'rel_user_id' => $id , 'rel_type' => '2' ))->get();
            if ($expert_relationship->count() == 0) {
                $rel_expert = null;
            }else{
                $rel_expert = "expert";
            }
        }else{
            $rel_friend = null;
            $rel_expert = null;
        }

        $this->layout->content = View::make('user.profile')->with(array(
                                                                    'user' => $user,
                                                                    'friends_number' => $friends_number,
                                                                    'expert_number' => $expert_number,
                                                                    'follow_number' => $follow_number,
                                                                    'rel_friend' => $rel_friend,
                                                                    'rel_expert' => $rel_expert
                                                                    ));
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
        
        try {
            $user = User::findOrFail($user_id);
            $unconfirmed_bill = Bill::where('status', 0)->get();
            $confirmed_bill = Bill::where('status', 1)->get();

            foreach ($unconfirmed_bill as $bill) {
                $bill_items = BillItem::where('bill_id', $bill->id)->get();
                $totalprice = 0;
                foreach($bill_items as $item)
                {
                    $it = Item::findOrFail($item->item_id);
                    $items_attr = $this->getOneItemAttributes($it);
                    $totalprice += $items_attr['20'] * $item->number;
                }
                $bill['totalprice'] = $totalprice;
            }

            foreach ($confirmed_bill as $bill) {
                $bill_items = BillItem::where('bill_id', $bill->id)->get();
                $totalprice = 0;
                foreach($bill_items as $item)
                {
                    $it = Item::findOrFail($item->item_id);
                    $items_attr = $this->getOneItemAttributes($it);
                    $totalprice += $items_attr['20'] * $item->number;
                }
                $bill['totalprice'] = $totalprice;
            }

        } catch(Exception $e) {
            return Response::json(404);
        }

        $this->layout->content = View::make('user.mybill')->with(array('manager_bills' => $unconfirmed_bill,
                                                                        'confirmed_bills' => $confirmed_bill));
    }

    public function makeBill(){
        $items_id = Input::get('chk');

        if (!Auth::check()) {
            return Redirect::to(URL::action('HomeController@showWelcome'));
        }else{
            $items = array();
            foreach ($items_id as $item) {
                $item = Item::find($item);
                array_push($items, $item);
            }
            $items_attr = $this->getItemAttributes($items);
            $this->layout->content = View::make('user.bill')->with(array('items' => $items ,
                                                                            'items_attr' => $items_attr,
                                                                            'isEdit' => (-1)
                                                                                ));
        }
    }

    public function editBill($id){
        if (!Auth::check()) {
            return Redirect::to(URL::action('HomeController@showWelcome'));
        }else{
            $bill_items = BillItem::where('bill_id', $id)->get();

            $items = array();
            foreach ($bill_items as $it) {
                $item = Item::find($it->item_id);
                $item['quantity'] = $it->number;
                array_push($items, $item);
            }
            $items_attr = $this->getItemAttributes($items);
            $this->layout->content = View::make('user.bill')->with(array('items' => $items ,
                                                                            'items_attr' => $items_attr,
                                                                            'isEdit' => $id
                                                                                ));
        }
    }

    public function deleteBill(){
        $id = Input::get('id');
        try {
            $bill = Bill::findOrFail($id);
            if($bill->status == 1)
                return Response::json(array("status" => "failed"));
            $bill_items = BillItem::where('bill_id', $id)->get();
            foreach ($bill_items as $item) {
                $item->delete();
            }
            $bill->delete();

        }catch(Exception $e) {
            return Response::json(array("status" => "failed"));
        }

        return Response::json(array("status" => "success"));
    }

    public function saveBill(){
        $input = Input::get('bill');
        $isEdit = Input::get('isEdit');

        if(empty($input))
            return Response::json(400);
        
        if (!Auth::check()) {
            return Redirect::to(URL::action('HomeController@showWelcome'));
        }else{
            if($isEdit > 0) {
                $bill = Bill::find($isEdit);
                $bill_items = BillItem::where('bill_id', $isEdit)->get();
                foreach ($bill_items as $it) {
                    $it->delete();
                }
            } else {
                $bill = new Bill;
            }
            $bill->user_id = Auth::user()->id;
            $bill->status = 0; // 0: non confirm | 1: confirmed
            $bill->save();
            foreach($input as $key => $value) {
                $b = new BillItem;
                $b->bill_id = $bill->id;
                $b->item_id = $key;
                $b->number = $value;
                $b->save();
            }
            return Response::json(200);
        }
    }

    public function getFriends($user_id){

    }

    public function friend(){
        $current_user_id = Auth::user()->id;
        $added_user_id = Input::get('id');
        $mode = Input::get('mode');
        
        $current_user = User::find($current_user_id);
        $added_user = User::find($added_user_id);
        if ($current_user == null || $added_user == null) {
            return Response::json ( array (
                'state' => 'error',
                'mes' => 'User not exist'
            ) );

        }

        if ($mode == 0 ) { // add friend action
            $rel = new Relationship;
            $rel->user_id = $current_user_id;
            $rel->rel_user_id = $added_user_id;
            $rel->rel_type = '1' ;
            $rel->save();

            $mes =  $added_user->name . ' has been added to your friendlist';
            return Response::json ( array (
                'state' => 'OK',
                'change_mode' => 1,
                'mes' => $mes
            ) );      
        }else{ // unfriend action
            $affectedRows = Relationship::where(array('user_id'=> $current_user_id , 'rel_user_id' => $added_user_id, 'rel_type' => '1'))->delete();
            if ($affectedRows == 0) {
                return Response::json ( array (
                    'state' => 'error',
                    'mes' => 'Relationship not exist'
                ));
            }else{ 
                $mes =  $added_user->name . ' has been  remove from your friendlist';
                return Response::json ( array (
                    'state' => 'OK',
                    'change_mode' => 0,
                    'mes' => $mes
                ));
            }
        }
        
    }

    public function expert(){
        $current_user_id = Auth::user()->id;
        $added_user_id = Input::get('id');
        $mode = Input::get('mode');
        
        $current_user = User::find($current_user_id);
        $added_user = User::find($added_user_id);
        if ($current_user == null || $added_user == null) {
            return Response::json ( array (
                'state' => 'error',
                'mes' => 'User not exist'
            ) );

        }

        if ($mode == 0 ) { // add expert action
            $rel = new Relationship;
            $rel->user_id = $current_user_id;
            $rel->rel_user_id = $added_user_id;
            $rel->rel_type = '2' ;
            $rel->save();

            $mes =  $added_user->name . ' has been added to your friendlist';
            return Response::json ( array (
                'state' => 'OK',
                'change_mode' => 1,
                'mes' => $mes
            ) );      
        }else{ // unfriend action
            $affectedRows = Relationship::where(array('user_id'=> $current_user_id , 'rel_user_id' => $added_user_id, 'rel_type' => '1'))->delete();
            if ($affectedRows == 0) {
                return Response::json ( array (
                    'state' => 'error',
                    'mes' => 'Relationship not exist'
                ));
            }else{ 
                $mes =  $added_user->name . ' has been  remove from your friendlist';
                return Response::json ( array (
                    'state' => 'OK',
                    'change_mode' => 0,
                    'mes' => $mes
                ));
            }
        }
        
    }
}
