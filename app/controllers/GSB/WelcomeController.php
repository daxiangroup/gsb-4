<?php namespace GSB;

use \BaseController;
use \Event;
use \View;

class WelcomeController extends BaseController
{
    public function getIndex()
    {
        return View::make('welcome.index');
    }
}
