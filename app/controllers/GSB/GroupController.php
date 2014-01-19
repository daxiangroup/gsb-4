<?php namespace GSB;

use \App;
use \Auth;
use \BaseController;
use \Event;
use \GSB\Group\GroupBuddyEntity;
use \GSB\Group\GroupEntity;
use \GSB\Group\GroupService;
use \Input;
use \Redirect;
use \Request;
use \View;

class GroupController extends BaseController {

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

        $this->repository = App::make('GroupRepository');
    }

    public function getIndex()
    {
        $groups = GroupService::getGroups();

        return View::make('group.index')
            ->with('active_link', 'group')
            ->with('groups', $groups);
    }

    public function postIndex()
    {
        $filter = Input::all();

        return $this->viewIndex(GroupService::getGroups($filter));
    }


    public function getMyGroups()
    {
        return View::make('group.my_groups')
            ->with('active_link', 'group.myGroups')
            ->with('groups', GroupService::getMyGroups((int) Auth::user()->id));
    }

    public function getGroupView($id)
    {
        $group_id = (int)Request::segment(2);
        $group    = new GroupEntity($group_id, true);

        // TODO: properly set an flashed error message
        if ($group->getHydrated() === false) {
            return Redirect::route('group');
        }

        return View::make('group.view')
            ->with('active_link', 'group')
            ->with('group', $group);
    }

    public function postGroupJoin()
    {
        $validation = GroupService::validate('group-join', Input::all());

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
                ->withErrors($validation);
        }

        $group_id   = Input::get('group_id');
        $profile_id = Input::get('profile_id');
        $group      = new GroupEntity($group_id,true);

        // Create a GroupsBuddyEntity and populate the POSTed fields.
        $buddy = new GroupBuddyEntity();
        $buddy->setGroupId($group_id);
        $buddy->setProfileId($profile_id);
        $buddy->setStatus(GroupBuddyEntity::VAL_STATUS_PENDING);

        // If at this point when we try to save, there are no spots left in the
        // group (last one was taken BEFORE user tried to save themselves (race
        // condition)), Redirect user back to the group view
        if (!$group->hasSpots()) {
            // Redirect the user to the profile form with a failure flag.
            return Redirect::route('group.view', array($group_id))
                ->with('success', false);
        }

        // The Group still has spots, so we can save the GroupsBuddyEntity.
        $success = $this->repository->saveBuddy($buddy);

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
        $validation = GroupService::validate('group-part', Input::all());

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
        $buddy = new GroupBuddyEntity();
        $buddy->setGroupId($group_id);
        $buddy->setProfileId($profile_id);

        // Remove the buddy from the Group.
        $success = $this->repository->deleteBuddy($buddy);

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
        $group = new GroupEntity();
        $group->setName(Input::old('group.name') != '' ? Input::old('group.name') : '');
        $group->setGraduatingYear(Input::old('group.graduating_year') != '' ? Input::old('group.graduating_year') : '');
        $group->setAdminId(Input::old('group.admin_id') != '' ? Input::old('group.admin_id') : '');
        $group->setAdminName(Input::old('group.admin_name') != '' ? Input::old('group.admin_name') : '');
        $group->setCoAdminId(Input::old('group.co_admin_id') != '' ? Input::old('group.co_admin_id') : '');
        $group->setCoAdminName(Input::old('group.co_admin_name') != '' ? Input::old('group.co_admin_name') : '');
        $group->setMaxSize(Input::old('group.max_size') != '' ? Input::old('group.max_size') : '');
        $group->setHeadline(Input::old('group.headline') != '' ? Input::old('group.headline') : '');
        $group->setDescription(Input::old('group.description') != '' ? Input::old('group.description') : '');
        $group->setVisibility(Input::old('group.visibility') != '' ? Input::old('group.visibility') : '');

        $form_values = GroupService::formValues('group-create', array(
            'group' => $group->fieldsAsArray(true, true),
        ));

        return View::make('group.create')
            ->with('active_link', 'group.create')
            ->with('form_values', $form_values);
    }

    public function postGroupCreate()
    {
        // TODO: use local variable for all Input::get()'s.
        $validation = GroupService::validate('group-create', Input::all());

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
        $group = new GroupEntity();
        $group->setName(Input::get('group.name'));
        $group->setGraduatingYear(Input::get('group.graduating_year'));
        $group->setAdminId($profile_id);
        $group->setCoAdminId(Input::get('group.co_admin_id'));
        $group->setMaxSize(Input::get('group.max_size'));
        $group->setHeadline(Input::get('group.headline'));
        $group->setDescription(Input::get('group.description'));
        $group->setVisibility(Input::get('group.visibility'));
        $group->setCreated();

        // Save the GroupEntity. $success will be the auto-incremented id of
        // the added group.
        $success = $this->repository->saveGroup($group);

        // Create the GroupBuddyEntity of the user creating the Group.
        $buddy = new GroupBuddyEntity();
        $buddy->setGroupId($success);
        $buddy->setProfileId($profile_id);
        $buddy->setStatus(GroupBuddyEntity::VAL_STATUS_APPROVED);
        $buddy->setCreated();

        // Save the GroupBuddyEntity.
        $success = $this->repository->saveBuddy($buddy);

        // Fire the group.save event so listeners know that an group
        // has been saved.
        $ep = array(
            'profile_id' => $profile_id,
            'type' => 'create',
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
        $group = new GroupEntity($id, true);

        $form_values = GroupService::formValues('group-create', array(
            'group' => $group->fieldsAsArray(true, true),
        ));

        return View::make('group.edit')
            ->with('active_link', 'group.edit')
            ->with('form_values', $form_values);
    }

    public function postGroupEdit($id)
    {
        $validation = GroupService::validate('group-create', Input::all());

        $profile_id = Auth::user()->id;

        // If the form validation fails, we want to flash the Input values so we
        // have them when re-displaying the form to the user, then Redirect.
        if ($validation->fails()) {
            Input::flash();

            return Redirect::route('group.edit')
                ->with('success', false)
                ->with_errors($validation->errors);
        }

        // Create a GroupEntity and populate the POSTed fields.
        $group = new GroupEntity();
        $group->setId($id);
        $group->setName(Input::get('group.name'));
        $group->setGraduatingYear(Input::get('group.graduating_year'));
        $group->setAdminId(Input::get('group.admin_id'));
        $group->setCoAdminId(Input::get('group.co_admin_id'));
        $group->setMaxSize(Input::get('group.max_size'));
        $group->setHeadline(Input::get('group.headline'));
        $group->setDescription(Input::get('group.description'));
        $group->setVisibility(Input::get('group.visibility'));
        $group->setBuddiesApproval(Input::get('group.buddies_approval'));
        $group->setCreated();

        // Save the GroupEntity
        $success = $this->repository->saveGroup($group);

        // Fire the group.save event so listeners know that an group
        // has been saved.
        $ep = array(
            'profile_id' => $profile_id,
            'type' => 'edit',
            'success' => $success,
            'timestamp' => time(),
        );
        Event::fire('group.save', array($ep));

        // Redirect the user to the profile form with a success flag.
        return Redirect::route('group')
            ->with('success', $success);
    }
}