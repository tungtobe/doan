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
                    $totalprice += $items_attr['Price'] * $item->number;
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
                    $totalprice += $items_attr['Price'] * $item->number;
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

    public function editBill($id)
    {
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

    public function deleteBill()
    {
        $id = Input::get('id');
        /*try*/ {
            $bill = Bill::findOrFail($id);
            if($bill->status == 1)
                return Response::json(array("status" => "failed"));
            $bill_items = BillItem::where('bill_id', $id)->get();
            foreach ($bill_items as $item) {
                $item->delete();
            }
            $bill->delete();

        }/*catch(Exception $e) {
            return Response::json(array("status" => "failed"));
        }*/

        return Response::json(array("status" => "success"));
    }

    public function saveBill()
    {
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
