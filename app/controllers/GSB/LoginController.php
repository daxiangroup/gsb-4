<?php namespace GSB;

use \BaseController;
use \View;
use \Cookie;
use \Auth;
use \Input;
use \Redirect;
use \App;
use \Event;
//use \GSB\Login\LoginService;

class LoginController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

    public function __construct()
    {
		$this->beforeFilter('csrf', array('on' => 'post'));
    }

    public function getIndex()
    {
        if (Cookie::get('gsb_remember_me') && LoginService::check_remember_me()) {
            return Redirect::to('/dashboard');
        }

        if (!Auth::guest()) {
            return Redirect::to('/dashboard');
        }

        return View::make('Login.index');
    }

    public function postIndex()
    {
        $LoginService = App::make('LoginService');

        $credentials = array(
            'email' => Input::get('login'),
            'password' => Input::get('password')
        );

        if (!$LoginService::attempt($credentials)) {
            return Redirect::route('login');
        }

        if (Input::get('remember_me')) {
            $LoginService::set_remember_me();
        }

        $LoginService::set_session();

        // Fire the login.login event so listeners know that an account has been
        // logged in.
        $ep = array(
            'profile_id' => Auth::user()->id,
            'success' => true,
            'timestamp' => time(),
        );
        Event::fire('login.login', array($ep));

        return Redirect::to('/dashboard');
    }

    public function getLogout()
    {
        $LoginService = App::make('LoginService');

        // Set the $profile_id before we kill the session so we can fire the logout
        // event and still track the profile.
        $profile_id = Auth::user()->id;
        //$profile_id = 1;

        $LoginService::logout();
        // Fire the login.logout event so listeners know that an account has been
        // logged out.
        $ep = array(
            'profile_id' => $profile_id,
            'success' => true,
            'timestamp' => time(),
        );
        Event::fire('login.logout', array($ep));

        return Redirect::route('home');
    }

}