<?php namespace GSB;

use \BaseController;
use \View;

class DashboardController extends BaseController {

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
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('auth');
    }

    public function getIndex()
    {
        return View::make('dashboard.index')
            ->with('active_link', '');
    }

}