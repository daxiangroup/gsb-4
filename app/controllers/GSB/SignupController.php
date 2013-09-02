<?php namespace GSB;

use \App;
use \Auth;
use \BaseController;
use \Event;
use \GSB\Profile\ProfileEntity;
use \GSB\Signup\SignupService;
use \Input;
use \Redirect;
use \User;
use \View;

class SignupController extends BaseController
{

    private $repository = null;

    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));

        $this->repository = App::make('ProfileRepository');
    }

    public function getIndex()
    {
        die('SignupController@getIndex');

        return View::make('login.index');
    }

    public function postIndex()
    {
        $data       = Input::all();
        $validation = SignupService::validate($data);

        // If the form validation fails, we want to flash the Input values so we
        // have them when re-displaying the form to the user, then Redirect.
        if ($validation->fails()) {
            Input::flash();

            // We're Redirect'ing to the 'groups.view' route, which is specific to
            // a group using a group_id value. If the group_id is not available
            // in the post, for whatever reason, this will end the user up on
            // 'groups' route by default.
            return Redirect::route('signup')
                ->with('success', false)
                ->withErrors($validation);
        }

        $profile = new ProfileEntity(null, false);
        $profile->setFullName($data['signup']['full_name']);
        $profile->setEmail($data['signup']['email']);
        $profile->setPassword($data['signup']['password']);
        $profile->setGraduatingYear($data['signup']['graduating_year']);
        $profile->setLanguage('en');
        $profile->setCreated();

        // Create the login credentials before hashing password so we can auto-
        // magically log the user in after successfully creating the Profile.
        $credentials = array(
            'email' => $profile->getEmail(),
            'password' => $profile->getPassword(),
        );

        // Now we hash the password to store to repository.
        $profile->hashPassword();

        $success = $this->repository->save($profile);

        // If had a problem with the Profile create, we should send them to the
        // signup page to display some errors.
        if (!$success) {
            // Fire the signup.join event so listeners know that a profile has
            // failed to be created.
            $ep = array(
                'profile_id' => 'null',
                'success' => false,
                'timestamp' => time(),
            );
            Event::fire('signup.join', array($ep));

            // TODO: include errors before redirect.
            return Redirect::route('signup');
        }

        // Log the user in before sending them to the welcome page.
        Auth::attempt($credentials);

        // Fire the signup.join event so listeners know that a profile has been
        // created.
        $ep = array(
            'profile_id' => Auth::user()->id,
            'success' => true,
            'timestamp' => time(),
        );
        Event::fire('signup.join', array($ep));

        return Redirect::route('welcome');
    }
}
