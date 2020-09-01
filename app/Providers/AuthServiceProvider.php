<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;


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

        //is mentor
        Gate::define('mentor', function($user) {
            return $user->roles == 'mentor';
        });

        //is student
        Gate::define('student', function($user) {
            return $user->roles == 'student';
        });

        $authUser = Auth::user();

        //visiting own profile
        Gate::define('ownProfile', function($authUser,$user) {
            return $authUser->id == $user->id;
        });
    }
}
