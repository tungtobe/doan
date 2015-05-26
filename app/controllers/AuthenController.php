<?php

use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\View;

class AuthenController extends BaseController {

    public function getLogin() {
        if (Auth::check()) {
            return Redirect::to(URL::action('HomeController@showWelcome'));
        }
        $this->layout->content = View::make('authen.login');
    }

   public function getSignup() {
        if (Auth::check()) {
            return Redirect::to(URL::action('HomeController@showWelcome'));
        }
        $this->layout->content = View::make('authen.signup');
    }

    public function login(){
        if (Auth::check()) {
            return Redirect::to(URL::action('HomeController@showWelcome'));
        }

        $validator = User::validate(Input::all());  
        if ($validator->fails()) {
            return Redirect::to(URL::action('AuthenController@getLogin'))->withInput()->withErrors($validator);     
        }

        $username = Input::get('username');
        $password = Input::get('password');
        $user = User::where(array(
                "username" => $username,
                "password" => md5($password),
                "status" => 1
            ))->first();
        if(is_null($user)){
            return Redirect::to(URL::action('AuthenController@getLogin'))->withInput()->withErrors(array('password'=>'Invalid username or password !!!')); 
        }else{
            Auth::login($user);
            return Redirect::to(URL::action('HomeController@showWelcome'));
        }
    }

    public function signup(){
        if (Auth::check()) {
            return Redirect::to(URL::action('HomeController@showWelcome'));
        }

        $validator = User::validate(Input::all());  
        if ($validator->fails()) {
            return Redirect::to(URL::action('AuthenController@getSignup'))->withInput()->withErrors($validator);     
        }

        $username = Input::get('username');
        $password = Input::get('password');
        $newuser = User::where(array(
                "username" => $username
            ))->first();

        if (is_null($newuser)) {
            $user = new User;
            $user->username = $username;
            $user->password = md5($password);
            $user->status = '1';
            $user->role = '1';
            $user->save();
            Auth::login($user);
            return Redirect::to(URL::action('HomeController@showWelcome'));
        }else{
            return Redirect::to(URL::action('AuthenController@getSignup'))->withInput()->withErrors(array('username'=>'username existed !!!')); 
        }
    }

    public function getLogout() {
        Auth::logout();
        return Redirect::to(URL::action('HomeController@showWelcome'));
    }

  

}

?>