<?php namespace GSB;

use \BaseController;
use \View;
use \Auth;
use \Input;
use \App;

class ProfileController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |   Route::get('/', 'HomeController@showWelcome');
    |
    */

    public function __construct()
    {
        $this->beforeFilter('auth');
        $this->beforeFilter('csrf', array('on' => 'post'));
    }

    public function getIndex()
    {
        $ProfileEntity = App::make('ProfileEntity');

        $profile = new $ProfileEntity(Auth::user()->id, true);
        $form_values['account_username'] = Input::old('account_username') != '' ? Input::old('account_username') : $profile->getUsername();
        $form_values['account_email'] = Input::old('account_email') != '' ? Input::old('account_email') : $profile->getEmail();
        $form_values['account_full_name'] = Input::old('account_full_name') != '' ? Input::old('account_full_name') : $profile->getFullName();
        $form_values['account_graduating_year'] = Input::old('account_graduating_year') != '' ? Input::old('account_graduating_year') : $profile->getGraduatingYear();
        $form_values['account_bio'] = Input::old('account_bio') != '' ? Input::old('account_bio') : $profile->getBio();

        return View::make('profile.index')
            ->with('active_link', 'profile')
            ->with('form_values', $form_values);
    }


    /**
     * Displaying the change password form to the user
     *
     * @return void
     */
    public function getPassword()
    {
        return View::make('profile.password')
            ->with('active_link', 'profile.password');
    }

    /**
     * Displaying the settings form to the user
     *
     * @return void
     */
    public function getSettings()
    {
        return View::make('profile.settings')
            ->with('active_link', 'profile.settings');
    }

}