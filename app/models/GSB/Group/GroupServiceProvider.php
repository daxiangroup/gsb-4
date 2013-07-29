<?php namespace GSB\Group;

use Illuminate\Support\ServiceProvider;

class GroupServiceProvider extends ServiceProvider {

    /**
     * Register the binding
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        $app->bind('GroupService',     'GSB\Group\GroupService');
        $app->bind('GroupFilter',      'GSB\Group\GroupFilter');
        $app->bind('GroupRepository',  'GSB\Group\GroupRepository');
        $app->bind('GroupEntity',      'GSB\Group\GroupEntity');
        $app->bind('GroupBuddyEntity', 'GSB\Group\GroupBuddyEntity');
    }

}
