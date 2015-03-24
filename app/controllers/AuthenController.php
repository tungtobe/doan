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
                "password" => md5($password)
            ))->first();
        if(is_null($user)){
            return Redirect::to(URL::action('AuthenController@getLogin'))->withInput()->withErrors(array('password'=>'wrong username or password !!!')); 
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
            return Redirect::to(URL::action('AuthenController@getLogin'))->withInput()->withErrors($validator);     
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
            return Redirect::to(URL::action('AuthenController@getLogin'))->withInput()->withErrors(array('username'=>'username existed !!!')); 
        }
        
    }


    

    public function loginWithFacebook() {
        $clientID = Config::get('params.facebook.clientID');
        $clientSecret = Config::get('params.facebook.clientSecret');
        $redirectURL = Config::get('params.facebook.redirectUrl');

        if (session_id() == '') { //check session
            session_start();
        }
        //get code and error which got from response of facebook.
        $code = isset($_REQUEST['code']) ? $_REQUEST['code'] : null;
        $error = array(
            "error_reason" => isset($_REQUEST["error_reason"]) ? $_REQUEST["error_reason"] : null,
            "error" => isset($_REQUEST["error"]) ? $_REQUEST["error"] : null,
            "error_description" => isset($_REQUEST["error_description"]) ? $_REQUEST["error_description"] : null
        );

        //Handling error or user revokes permission
        if (!empty($error["error"])) {
            // If user decided to decline the permission
            if ($error["error_reason"] === "user_denied") {
                // Redirect back to homepage page
                Redirect::to(URL::action('HomeController@showWelcome'));
            }
            // In case unexpect error occur
            else {
                // Redirect to error page
                // Throw exception and display error_reason and error description
                Throw new CHttpException("200", $error["error_reason"] . ": " . $error["error_description"]);
            }
        }

        //If user is not login yet
        //Redirect to login dialog
        if (empty($code)) {
            // Create an unique session state
            $_SESSION['state'] = md5(uniqid(rand(), TRUE)); // CSRF protection
            // Request permission by using scope
            // Permission request : Basic Information, user birthday, user education history
            $dialog_url = "https://www.facebook.com/dialog/oauth?" .
                    "client_id=" . $clientID .
                    "&redirect_uri=" . urlencode($redirectURL) . // TODO: change it later
                    "&state=" . $_SESSION['state'] .
                    "&scope=email";
            return Redirect::to($dialog_url);
        }

        //Check if state varibale matches or not
        if (isset($_SESSION['state']) && ($_SESSION['state'] == $_REQUEST['state'])) {
            // state variable matches
            // Exchange the code for access token
            $token_url = "https://graph.facebook.com/oauth/access_token?" .
                    "client_id=" . $clientID .
                    "&redirect_uri=" . urlencode($redirectURL) .
                    "&client_secret=" . $clientSecret .
                    "&code=" . $code;

            // Handling on error when exchange access token
            if (($response = @file_get_contents($token_url)) === FALSE) {
                // Throw exception
                Throw new CHttpException("200", "Something went wrong when we are logging you in");
                session_destroy();
            }
            $params = null;
            parse_str($response, $params);
            // Save access token to session parameters
            $_SESSION['access_token'] = $params['access_token'];

            // Query information that is requested
            $graph_url = "https://graph.facebook.com/me?" .
                    "access_token=" . $params['access_token'];
            if (($user = @json_decode(file_get_contents($graph_url))) === NULL) {
                // Throw exception
                Throw new CHttpException("200", "Something went wrong when we are logging you in");
                session_destroy();
            }

            $newuser = User::where(array(
                        'unique_id' => md5($user->id),
                        'type' => "fb",
                    ))->first();
            if (is_null($newuser)) {
                $newuser = new User;
                $newuser->username = $user->first_name . " " . $user->last_name;
                $newuser->unique_id = md5($user->id);
                $newuser->type = "fb";
                $newuser->access_token = $params['access_token'];
                $newuser->save();
                Auth::login($newuser);
                return Redirect::intended(URL::action('HomeController@showWelcome'));
            } else {
                //update facebook_username
                $newuser->username = $user->first_name . " " . $user->last_name;
                $newuser->access_token = $_SESSION['access_token'];
                $newuser->save();
                Auth::login($newuser);

                return Redirect::intended(URL::action('HomeController@showWelcome'));
            }
        } else {
            // Redirect to error page
            // Throw exception
            Throw new CHttpException("404", "Session error. You do not have a valid session");
            session_destroy();
        }

        // Destroy session on login success
        session_destroy();
    }

    public function getLogout() {
        Auth::logout();
        return Redirect::to(URL::action('HomeController@showWelcome'));
    }

}

?>