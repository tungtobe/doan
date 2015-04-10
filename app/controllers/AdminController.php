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
        $this->layout->content = View::make('admin.showitem');
    }

    public function addItem(){
        $this->layout->content = View::make('admin.additem');
    }
    public function showBill(){
        $this->layout->content = View::make('admin.showbill');
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

}
