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

        Gate::define('mentor', function($user) {
            return $user->roles == 'mentor';
        });

        /* define a manager user role */
        Gate::define('student', function($user) {
            return $user->roles == 'student';
        });
        $authUser = Auth::user();

        Gate::define('ownProfile', function($authUser,$user) {
            return $authUser->id == $user->id;
        });

        Gate::define('submittedAlready', function($user,$vars){ //$assignment
            //check if the user submitted an answer for an assignment
            $authUser = auth()->user();

            if (($authUser->id == $submission->user_id)
                &&
                ($submission->assignment_id == $assignment->id)){
                return true;
            }else{
                return false;
            }

        });
    }

}
