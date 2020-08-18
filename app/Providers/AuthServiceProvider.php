<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {

        $this->registerPolicies();

        Gate::define('mentor', function($user) {
            return $user->role == 'mentor';
        });

        /* define a manager user role */
        Gate::define('student', function($user) {
            return $user->role == 'student';
        });

        $authUser = Auth::user();

        Gate::define('ownProfile', function($authUser,$user) {
            return $authUser->id == $user->id;
        });
    }

}
