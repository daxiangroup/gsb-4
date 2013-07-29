<?php namespace GSB\Login;

use Illuminate\Support\ServiceProvider;

class LoginServiceProvider extends ServiceProvider {

    /**
     * Register the binding
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        $app->bind('LoginService', 'GSB\Login\LoginService');
    }

}
