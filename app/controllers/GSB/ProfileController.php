<?php namespace GSB;

use \App;
use \Auth;
use \BaseController;
use \Event;
use \GSB\Profile\ProfileEntity;
use \GSB\Profile\ProfileService;
use \Input;
use \Redirect;
use \View;

class ProfileController extends BaseController
{

    private $repository = null;

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

        $this->repository = App::make('ProfileRepository');
    }

    public function getIndex()
    {
        $profile = new ProfileEntity((int)Auth::user()->id, true);
        $form_values['account_username'] = Input::old('account_username') != '' ? Input::old('account_username') : $profile->getUsername();
        $form_values['account_email'] = Input::old('account_email') != '' ? Input::old('account_email') : $profile->getEmail();
        $form_values['account_full_name'] = Input::old('account_full_name') != '' ? Input::old('account_full_name') : $profile->getFullName();
        $form_values['account_graduating_year'] = Input::old('account_graduating_year') != '' ? Input::old('account_graduating_year') : $profile->getGraduatingYear();
        $form_values['account_bio'] = Input::old('account_bio') != '' ? Input::old('account_bio') : $profile->getBio();

        return View::make('profile.index')
            ->with('active_link', 'profile')
            ->with('form_values', $form_values);
    }

    public function postIndex()
    {
        $data       = Input::all();
        $validation = ProfileService::validate('profile', $data);
        $profile_id = Auth::user()->id;

        // If the form validation fails, we want to flash the Input values so we
        // have them when re-displaying the form to the user, then Redirect.
        if ($validation->fails()) {
            Input::flash();

            return Redirect::route('profile')
                ->with('success', false)
                ->withErrors($validation);
        }

        // Create a ProfileEntity and populate the POSTed fields.
        $profile = new ProfileEntity((int)$profile_id);
        $profile->setUsername($data['profile']['username']);
        $profile->setEmail($data['profile']['email']);
        $profile->setFullName($data['profile']['full_name']);
        $profile->setGraduatingYear($data['profile']['graduating_year']);
        $profile->setBio($data['profile']['bio']);

        // Save the ProfileEntity
        $success = $this->repository->save($profile);

        // Fire the profile.account_save event so listeners know that an account
        // has been saved.
        $ep = array(
            'profile_id' => $profile_id,
            'success' => $success,
            'timestamp' => time(),
        );
        Event::fire('profile.save', array($ep));

        // Redirect the user to the profile form with a success flag.
        return Redirect::route('profile')
            ->with('success', $success);
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

    public function postPassword()
    {
        $data       = Input::all();
        $validation = ProfileService::validate('profile.password', $data);
        $profile_id = Auth::user()->id;

        // If the form validation fails, we want to flash the Input values so we
        // have them when re-displaying the form to the user, then Redirect.
        if ($validation->fails()) {
            Input::flash();

            return Redirect::route('profile.password')
                ->with('success', false)
                ->withErrors($validation);
        }

        // Create a ProfileEntity and populate the POSTed fields.
        $profile = new ProfileEntity((int)$profile_id);
        $profile->setPassword($data['password']['new']);
        $profile->hashPassword();

        // Save the ProfileEntity
        $success = $this->repository->save($profile);

        // Fire the profile.account_save event so listeners know that an account
        // has been saved.
        $ep = array(
            'profile_id' => $profile_id,
            'success' => $success,
            'timestamp' => time(),
        );
        Event::fire('profile.password.save', array($ep));

        // Redirect the user to the profile form with a success flag.
        return Redirect::route('profile.password')
            ->with('success', $success);
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
