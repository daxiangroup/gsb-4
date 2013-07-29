<?php namespace GSB;

use \App;
use \Auth;
use \BaseController;
use \Event;
use \Input;
use \Redirect;
use \Request;
use \View;

class GroupController extends BaseController {

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
        $GroupService = App::make('GroupService');

        $groups = $GroupService::getGroups();

        return View::make('group.index')
            ->with('active_link', 'group')
            ->with('groups', $groups);
    }

    public function postIndex()
    {
        $GroupService = App::make('GroupService');

        $filter = Input::all();

        return $this->viewIndex($GroupService::getGroups($filter));
    }


    public function getMyGroups()
    {
        $GroupService = App::make('GroupService');

        return View::make('group.my_groups')
            ->with('active_link', 'group.myGroups')
            ->with('groups', $GroupService::getMyGroups((int) Auth::user()->id));
    }

    public function getGroupView($id)
    {
        $GroupEntity = App::make('GroupEntity');

        $group = new $GroupEntity(Request::segment(2), true);

        return View::make('group.view')
            ->with('active_link', 'groups')
            ->with('group', $group);
    }

    public function postGroupJoin()
    {
        $GroupService     = App::make('GroupService');
        $GroupEntity      = App::make('GroupEntity');
        $GroupBuddyEntity = App::make('GroupBuddyEntity');
        $GroupRepository  = App::make('GroupRepository');

        $validation = $GroupService::validate('group-join', Input::all());

        // If the form validation fails, we want to flash the Input values so we
        // have them when re-displaying the form to the user, then Redirect.
        if ($validation->fails()) {
            Input::flash();

            // We're Redirect'ing to the 'groups.view' route, which is specific to
            // a group using a group_id value. If the group_id is not available
            // in the post, for whatever reason, this will end the user up on
            // 'groups' route by default.
            return Redirect::route('group.view', array($group_id))
                ->with('success', false)
                ->with_errors($validation->errors);
        }

        $group_id   = Input::get('group_id');
        $profile_id = Input::get('profile_id');
        $group      = new $GroupEntity($group_id,true);

        // Create a GroupsBuddyEntity and populate the POSTed fields.
        $buddy = new $GroupBuddyEntity();
        $buddy->setGroupId($group_id);
        $buddy->setProfileId($profile_id);
        $buddy->setStatus($GroupBuddyEntity::STATUS_PENDING);

        // If at this point when we try to save, there are no spots left in the
        // group (last one was taken BEFORE user tried to save themselves (race
        // condition)), Redirect user back to the group view
        if (!$group->hasSpots()) {
            // Redirect the user to the profile form with a failure flag.
            return Redirect::route('group.view', array($group_id))
                ->with('success', false);
        }

        // The Group still has spots, so we can save the GroupsBuddyEntity.
        $success = $GroupRepository::saveBuddy($buddy);

        // Fire the group.buddy_save event so listeners know that an account has
        // joined a study group.
        $ep = array(
            'profile_id' => $profile_id,
            'group_id' => $group_id,
            'success' => $success,
            'timestamp' => time(),
        );
        Event::fire('group.buddy_save', array($ep));

        // Redirect the user to the profile form with a success flag.
        return Redirect::route('group.view', array($group_id))
            ->with('success', $success);
    }

    public function postGroupPart()
    {
        $GroupService     = App::make('GroupService');
        $GroupBuddyEntity = App::make('GroupBuddyEntity');
        $GroupRepository  = App::make('GroupRepository');

        $validation = $GroupService::validate('group-part', Input::all());

        if ($validation->fails()) {
            // We're Redirect'ing to the 'groups.my_groups' route if we have a
            // validation problem.
            return Redirect::route('group.myGroups')
                ->with('success', false)
                ->with_errors($validation->errors);
        }

        $group_id   = Input::get('group_id');
        $profile_id = Input::get('profile_id');

        // Create a GroupsBuddyEntity and populate the POSTed fields.
        $buddy = new $GroupBuddyEntity();
        $buddy->setGroupId($group_id);
        $buddy->setProfileId($profile_id);

        // Remove the buddy from the Group.
        $success = $GroupRepository::deleteBuddy($buddy);

        // Fire the groups.buddy_delete event so listeners know that an account has
        // parted a study group.
        $ep = array(
            'profile_id' => $profile_id,
            'group_id' => $group_id,
            'success' => $success,
            'timestamp' => time(),
        );
        Event::fire('group.buddy_save', array($ep));

        // Redirect the user to the my_groups view with a success flag.
        return Redirect::route('group.myGroups')
            ->with('success', $success);

    }

    private function viewIndex($groups = null)
    {
        return View::make('group.index')
            ->with('active_link', 'groups')
            ->with('groups', $groups);
    }

    public function getGroupCreate()
    {
        $GroupService = App::make('GroupService');
        $GroupEntity  = App::make('GroupEntity');
        /*
        $form_values['account_username'] = Input::old('account_username') != '' ? Input::old('account_username') : $profile->getUsername();
        $form_values['account_email'] = Input::old('account_email') != '' ? Input::old('account_email') : $profile->getEmail();
        $form_values['account_full_name'] = Input::old('account_full_name') != '' ? Input::old('account_full_name') : $profile->getFullName();
        $form_values['account_graduating_year'] = Input::old('account_graduating_year') != '' ? Input::old('account_graduating_year') : $profile->getGraduatingYear();
        $form_values['account_bio'] = Input::old('account_bio') != '' ? Input::old('account_bio') : $profile->getBio();
        */
        /*
        $form_values['group_name'] = '';
        $form_values['group_graduating_year'] = '';
        $form_values['group_admin'] = Auth::user()->full_name;
        $form_values['group_admin_id'] = Auth::user()->id;
        $form_values['group_co_admin'] = '';
        $form_values['group_co_admin_id'] = '';
        $form_values['group_max_size'] = '';
        $form_values['group_description'] = '';
        $form_values['group_headline'] = '';
        $form_values['group_visibility']['open']['value'] = $GroupEntity::VAL_VISIBILITY_OPEN;
        $form_values['group_visibility']['open']['checked'] = true;
        $form_values['group_visibility']['closed']['value'] = $GroupEntity::VAL_VISIBILITY_CLOSED;
        $form_values['group_visibility']['closed']['checked'] = false;
        $form_values['group_visibility']['private']['value'] = $GroupEntity::VAL_VISIBILITY_PRIVATE;
        $form_values['group_visibility']['private']['checked'] = false;
        */
        $form_values = $GroupService::formValues('group-create');

        return View::make('group.create')
            ->with('active_link', 'group.create')
            ->with('form_values', $form_values);
    }

    public function postGroupCreate()
    {
        $GroupService    = App::make('GroupService');
        $GroupEntity     = App::make('GroupEntity');
        $GroupRepository = App::make('GroupRepository');

        $validation = $GroupService::validate('group-create', Input::all());

        $profile_id = Auth::user()->id;

        // If the form validation fails, we want to flash the Input values so we
        // have them when re-displaying the form to the user, then Redirect.
        if ($validation->fails()) {
            Input::flash();

            return Redirect::route('group.create')
                ->with('success', false)
                ->with_errors($validation->errors);
        }

        // Create a GroupEntity and populate the POSTed fields.
        $group = new $GroupEntity();
        $group->setName(Input::get('group.name'));
        $group->setGraduatingYear(Input::get('group.graduating_year'));
        $group->setAdminId(Input::get('group.admin_id'));
        $group->setCoAdminId(Input::get('group.co_admin_id'));
        $group->setMaxSize(Input::get('group.max_size'));
        $group->setHeadline(Input::get('group.headline'));
        $group->setDescription(Input::get('group.description'));
        $group->setVisibility(Input::get('group.visibility'));
        $group->setCreated();

        // Save the GroupEntity
        $success = $GroupRepository::saveGroup($group);

        // TODO: After creating a group, add the creator to the buddies list

        // Fire the group.save event so listeners know that an group
        // has been saved.
        $ep = array(
            'profile_id' => $profile_id,
            'success' => $success,
            'timestamp' => time(),
        );
        Event::fire('group.save', array($ep));

        // Redirect the user to the profile form with a success flag.
        return Redirect::route('group')
            ->with('success', $success);
    }

    public function getGroupEdit($id)
    {
        $GroupService = App::make('GroupService');
        $GroupEntity  = App::make('GroupEntity');

        $group = new GroupEntity($id, true);

        $form_values = $GroupService::formValues('group-create', array(
            'group' => $group,
        ));

        return View::make('group.create')
            ->with('active_link', 'group.create')
            ->with('form_values', $form_values);
    }
}