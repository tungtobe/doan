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
        $users = User::where('status', 1)->paginate(2);
        //$users = User::Paginate(2);
        $this->layout->content = View::make('admin.showuser')
                                    ->with('users', $users);
    }

    public function showDeactiveUser(){
        $users = User::where('status', 0)->paginate(2);
        $this->layout->content = View::make('admin.showdeactiveuser')
                                    ->with('users', $users);
    }

    public function showItem(){
        $items = Item::orderBy('id', 'dsc')->paginate(10);
        $this->layout->content = View::make('admin.showitem')
                                    ->with('items', $items);
    }

    public function addItem(){
        $this->layout->content = View::make('item.add');
    }

    public function postAddItem()
    {
        // validate
        $rules = array(
            'name' => 'required',
            'manufacturer' => 'required'
            );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails())
        {
            return Redirect::to(URL::action('AdminController@addItem'))->withErrors($validator);
        }
        else {
            $input = Input::all();

            /// TODO: save item here
        }
        return Redirect::to(URL::action('AdminController@showItem'));
    }

    public function showBill(){
        $bills = Bill::Paginate(3);
        foreach($bills as $bill)
        {
            $user = User::find($bill->user_id);
            $bill['user'] = $user->username;
        }


        $this->layout->content = View::make('admin.showbill')->with(array('bills' => $bills));
    }

    public function viewBill()
    {
        $this->layout->content = View::make('admin.showsystemvar');
    }

    public function confirmBill()
    {
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

    public function deleteBill()
    {
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

    public function showSystemVar(){
        $this->layout->content = View::make('admin.showsystemvar');
    }

    /**
     * ban given user
     */
    public function postBanUser()
    {
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

    /**
     * grant or revoke admin permission of a user
     */
    public function changeAdminPermission()
    {
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
    public function postDeleteItem()
    {
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

    public function postEditItem($id)
    {
        if (!Auth::check() || Auth::user()->role != 0) 
            return Response::json("need admin right");
        
        $item = Item::find($id);
        
        if (Request::isMethod('post'))
        {
            // validate
            $rules = array(
                'name' => 'required',
                'manufacturer' => 'required'
                );
            $validator = Validator::make(Input::all(), $rules);
            if($validator->fails())
            {
                return Redirect::to(URL::action('AdminController@postEditItem', $id))->withErrors($validator);
            }
            else {
                $input = Input::all();

                /// TODO: save item here
            }
            return Redirect::to(URL::action('AdminController@showItem'));
        }

        $attr = $this->getOneItemAttributes($item);
        if($item == null) 
            return Response::json(404);

        $this->layout->content = View::make('item.edit')->with(array('item_id' => $id, 'attr' => $attr));
    }
}
