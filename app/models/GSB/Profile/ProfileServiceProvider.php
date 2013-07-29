<?php namespace GSB\Profile;

use Illuminate\Support\ServiceProvider;

class ProfileServiceProvider extends ServiceProvider {

    /**
     * Register the binding
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        $app->bind('ProfileRepository', 'GSB\Profile\ProfileRepository');
        $app->bind('ProfileEntity', 'GSB\Profile\ProfileEntity');
    }

}
