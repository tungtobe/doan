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
        $this->layout->content = View::make('admin.showuser');
    }

    public function showDeactiveUser(){
        $this->layout->content = View::make('admin.showdeactiveuser');
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

}
