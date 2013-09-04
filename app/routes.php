<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*
Route::get('/', array('as'=>'home', function()
{
	return View::make('hello');
}));
*/

/*****[ Login/Signup, Logout ]*************************************************/
Route::get('/',                 array('as'=>'home',              'uses'=>'GSB\LoginController@getIndex'));

Route::get('/login',            array('as'=>'login',             'uses'=>'GSB\LoginController@getIndex'));
Route::post('/login',           array(                           'uses'=>'GSB\LoginController@postIndex'));
Route::get('/logout',           array('as'=>'logout',            'uses'=>'GSB\LoginController@getLogout'));

Route::get('/signup',           array('as'=>'signup',            'uses'=>'GSB\SignupController@getIndex'));
Route::post('/signup',          array('as'=>'signup.join',       'uses'=>'GSB\SignupController@postIndex'));

/*****[ Welcome ]**************************************************************/
Route::get('/welcome',          array('as'=>'welcome',           'uses'=>'GSB\WelcomeController@getIndex'));

/*****[ Dashboard ]************************************************************/
Route::get('/dashboard',        array('as'=>'dashboard',         'uses'=>'GSB\DashboardController@getIndex'));

/*****[ Profiles ]*************************************************************/
Route::get('/profile',          array('as'=>'profile',           'uses'=>'GSB\ProfileController@getIndex'));
Route::post('/profile',         array('as'=>'profile.save',      'uses'=>'GSB\ProfileController@postIndex'));
Route::get('/profile/password', array('as'=>'profile.password',  'uses'=>'GSB\ProfileController@getPassword'));
Route::get('/profile/settings', array('as'=>'profile.settings',  'uses'=>'GSB\ProfileController@getSettings'));
Route::get('/profile/{id}',     array('as'=>'profile.view',      'uses'=>'GSB\ProfileController@getProfileView'));

/*****[ Groups ]***************************************************************/
Route::get('/group',            array('as'=>'group',             'uses'=>'GSB\GroupController@getIndex'));
Route::post('/group',           array('as'=>'group.filter',      'uses'=>'GSB\GroupController@postIndex'));
Route::get('/group/my-groups',  array('as'=>'group.myGroups',    'uses'=>'GSB\GroupController@getMyGroups'));
Route::get('/group/{id}',       array('as'=>'group.view',        'uses'=>'GSB\GroupController@getGroupView'))
    ->where('id', '[0-9]+');
Route::post('/group/{id}/join', array('as'=>'group.join',        'uses'=>'GSB\GroupController@postGroupJoin'))
    ->where('id', '[0-9]+');
Route::post('/group/part',      array('as'=>'group.part',        'uses'=>'GSB\GroupController@postGroupPart'));
Route::get('/group/create',     array('as'=>'group.create',      'uses'=>'GSB\GroupController@getGroupCreate'));
Route::post('/group/create',    array('as'=>'group.createSave',  'uses'=>'GSB\GroupController@postGroupCreate'));
Route::get('/group/{id}/edit',  array('as'=>'group.edit',        'uses'=>'GSB\GroupController@getGroupEdit'))
    ->where('id', '[0-9]+');
Route::post('/group/{id}/edit', array('as'=>'group.editSave',    'uses'=>'GSB\GroupController@postGroupEdit'))
    ->where('id', '[0-9]+');