<?php namespace GSB\Group;

use Illuminate\Support\ServiceProvider;

class GroupServiceProvider extends ServiceProvider
{
    /**
     * Register the binding
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        $app->bind('GroupRepository', 'GSB\Group\GroupEloquentRepository');
    }
}
