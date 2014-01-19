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

class BuddyController extends BaseController
{

    private $repository = null;

    public function __construct()
    {
        $this->addFilters();

        $this->repository = App::make('ProfileRepository');
    }

    public function getIndex()
    {
        return 'BuddyController';

        return View::make('profile.index')
            ->with('active_link', 'profile')
            ->with('form_values', $form_values);
    }

    public function getView($id)
    {
        $buddy = new ProfileEntity((int)$id, true);

        return View::make('Buddy.view')
            ->with('active_link', 'buddy.view')
            ->with('buddy', $buddy);
    }
}
