<?php namespace GSB\Signup;

use Illuminate\Support\ServiceProvider;

class SignupServiceProvider extends ServiceProvider
{

    /**
     * Register the binding
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        $app->bind('SignupService', 'GSB\Signup\SignupService');
    }
}
