<?php

class AdminController extends BaseController {
    protected $layout = 'layouts.admin';

    public function getShow() {
        $this->layout->content = View::make('admin.usermanager');        
    }

    public function addUser(){
        if (Auth::check()) {
            if (Auth::user()->role != 0){ // not admin
                return Redirect::to(URL::action('HomeController@showWelcome'));
            }
            
            // xử lý dữ liệu gửi lên
            if (Request::isMethod('post')){
                $validator = User::validate(Input::all());  
                if ($validator->fails()) {
                    return Redirect::to(URL::action('AdminController@addUser'))->withInput()->withErrors($validator);     
                }

                $username = Input::get('username');
                $password = Input::get('password');
                $role = Input::get('role');
                $newuser = User::where(array(
                        "username" => $username
                    ))->first();

                if (is_null($newuser)) {
                    $user = new User;
                    $user->username = $username;
                    $user->password = md5($password);
                    $user->status = '1';
                    $user->role = $role;
                    $user->save();
                    return Redirect::to(URL::action('AdminController@addUser'))->with('message', 'Success !!!');;
                }else{
                    return Redirect::to(URL::action('AdminController@addUser'))->withInput()->withErrors(array('username'=>'username existed !!!')); 
                }
            }

            $this->layout->content = View::make('admin.adduser');


        }else {
            return Redirect::to(URL::action('HomeController@showWelcome'));
        }        
    }

    public function showUser(){
        if (Auth::user()->role != 0){ // not admin
            return Redirect::to(URL::action('HomeController@showWelcome'));
        }

        $users = User::where('status', 1)->paginate(10);
        //$users = User::Paginate(2);
        $this->layout->content = View::make('admin.showuser')
                                    ->with('users', $users);
    }

    public function showDeactiveUser(){
        if (Auth::user()->role != 0){ // not admin
            return Redirect::to(URL::action('HomeController@showWelcome'));
        }


        $users = User::where('status', 0)->paginate(10);
        $this->layout->content = View::make('admin.showdeactiveuser')
                                    ->with('users', $users);
    }

    public function showItem(){
        if (Auth::user()->role != 0){ // not admin
            return Redirect::to(URL::action('HomeController@showWelcome'));
        }


        $items = Item::orderBy('id', 'dsc')->paginate(10);
        $this->layout->content = View::make('admin.showitem')
                                    ->with('items', $items);
    }

    public function addItem(){
        if (Auth::user()->role != 0){ // not admin
            return Redirect::to(URL::action('HomeController@showWelcome'));
        }

        $attributes = Attribute::all(); 
        $this->layout->content = View::make('item.add')->with(array('attributes' => $attributes));
    }

    public function postAddItem(){
        // validate
        $rules = array(
            '1' => 'required',
            '20' => 'required',
            '6' => 'required'
            );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails())
        {
            return Redirect::to(URL::action('AdminController@addItem'))->withErrors($validator);
        }
        else {
            $inputs = Input::all();
            $name = Input::get('1');
            $new_item = new Item;
            $new_item->name = $name;
            $new_item->status = '1';
            $new_item->save();
            $new_item_id = $new_item->id;
            foreach ($inputs as $key => $value) {
                if ($key != '_token')  {
                    if ($value != "") {
                        $new_value = new Value;
                        $new_value->item_id = $new_item_id;
                        $new_value->attr_id = $key;
                        $new_value->value = $value;
                        $new_value->save();
                    }
                }
            }
        }
        return Redirect::to(URL::action('AdminController@showItem'));
    }

    public function showBill(){
        if (Auth::user()->role != 0){ // not admin
            return Redirect::to(URL::action('HomeController@showWelcome'));
        }


        $bills = Bill::Paginate(12);
        foreach($bills as $bill)
        {
            $user = User::find($bill->user_id);
            $bill['user'] = $user->username;
        }


        $this->layout->content = View::make('admin.showbill')->with(array('bills' => $bills));
    }

    public function confirmBill(){
        if (Auth::user()->role != 0){ // not admin
            return Response::json(404);
        }

        $id = Input::get('id');

        try{
            $bill = Bill::findOrFail($id);
            if($bill->status == 1)
                $bill->status = 0;
            elseif($bill->status == 0)
                $bill->status = 1;
            $bill->save();
        } catch(Exception $e) {
            return Response::json('invalid');
        }

        return Response::json('Success');
    }

    public function deleteBill(){
        if (Auth::user()->role != 0){ // not admin
            return Response::json(404);
        }

        $id = Input::get('id');
        try {
            $bill = Bill::findOrFail($id);
            $bill_items = BillItem::where('bill_id', $id)->get();
            foreach ($bill_items as $item) {
                $item->delete();
            }
            $bill->delete();
        } catch(Exception $e) {
            return Response::json('invalid');
        }

        return Response::json('Success');
    }

    public function postSysVar(){
        if (Auth::user()->role != 0){ // not admin
            return Redirect::to(URL::action('HomeController@showWelcome'));
        }

        // Xử lý dữ liệu gửi lên
        $validator = Setting::validate(Input::all());  
        if ($validator->fails()) {
            return Redirect::to(URL::action('AdminController@showSystemVar'))->withInput()->withErrors($validator);     
        }

        $unchange = Input::get("unchange");
        $changed = Input::get("changed");

        $unchange_var = Setting::where('key','unchange')->first();
        if ($unchange_var == null) {
            $unchange_var = new Setting;
            $unchange_var->key = "unchange";
            $unchange_var->value = $unchange;
            $unchange_var->save();
        }else{
            $unchange_var->value = $unchange;
            $unchange_var->save();
        }

        $changed_var = Setting::where('key','changed')->first();
        if ($changed_var == null) {
            $changed_var = new Setting;
            $changed_var->key = "changed";
            $changed_var->value = $changed;
            $changed_var->save();
        }else{
            $changed_var->value = $changed;
            $changed_var->save();
        }
                
        return Redirect::to(URL::action('AdminController@showSystemVar'));
    }

    public function showSystemVar(){
        // show system var         
        $unchange_var = Setting::where('key','unchange')->first();
        if ($unchange_var == null) {
            $unchange = 1;
        }else{
            $unchange = $unchange_var->value;
        }

        $changed_var = Setting::where('key','changed')->first();
        if ($changed_var == null) {
            $changed = 2;
        }else{
            $changed = $changed_var->value;
        }

        $this->layout->content = View::make('admin.showsystemvar')->with(array(
                                                                        'unchange' => $unchange,
                                                                        'changed' => $changed
                                                                        ));
    }

    public function postBanUser(){
        if (!Auth::check() || Auth::user()->role != 0) 
            return Response::json("invalid");

        try {
            $input = Input::all();
            $id = $input['id'];

            if($id == Auth::id()) 
                throw new Exception("same user id", 1);
                  
            $user = User::find($id);

            if($user->status == 1)
                $user->status = 0;
            elseif($user->status == 0) 
                $user->status = 1;
            $user->save();

        } catch(Exception $e) {
            return Response::json("invalid");
        }

        return Response::json("Success");
    }


    public function changeAdminPermission(){
        if (!Auth::check() || Auth::user()->role != 0) 
            return Response::json("need admin right");
        try {
            $input = Input::all();
            $id = $input['id'];

            if($id == Auth::id()) 
                throw new Exception("same user id", 1);
                  
            $user = User::find($id);

            if($user->role == 0)
                $user->role = 1;
            elseif($user->role == 1) 
                $user->role = 0;

            $user->save();

        } catch(Exception $e) {
            return Response::json("invalid");
        }
        
        return Response::json("Success");
    }

    /**
     * delete an item from store
     * softdelete only
     */
    public function postDeleteItem(){
        if (!Auth::check() || Auth::user()->role != 0) 
            return Response::json("need admin right");

        try {
            $input = Input::all();
            $id = $input['id'];

            $item = Item::find($id);

            $item->delete();
        } catch(Exception $e) {
            return Response::json("invalid");
        }
        
        return Response::json("Success");
    }

    public function postEditItem($id){
        if (!Auth::check() || Auth::user()->role != 0) 
            return Response::json("need admin right");
        
        $item = Item::find($id);
        
        if (Request::isMethod('post'))
        {
            // validate
            $rules = array(
                '1' => 'required',
                );
            $validator = Validator::make(Input::all(), $rules);
            if($validator->fails())
            {
                return Redirect::to(URL::action('AdminController@postEditItem', $id))->withErrors(array("Enter item name !!! "));
            }
            else {
                $item->name = Input::get('1');
                $item->save();

                $inputs = Input::all();
                $old_values = Value::where('item_id', $id)->delete();
                foreach ($inputs as $key => $value) {
                    if ($key != '_token') {
                        Value::insert(array('item_id' => $id, 'attr_id' => $key , 'value' => $value));
                    }
                    
                }
            }
            return Redirect::to(URL::action('ItemController@getShow', $id));
        }

        $attr = $this->getOneItemAttributes($item);
        if($item == null) 
            return Response::json(404);
        $attributes = Attribute::all(); 
        $this->layout->content = View::make('item.edit')->with(array('item' => $item, 'attr' => $attr , 'attributes' => $attributes));
    }
}
