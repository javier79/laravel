<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-post',function($user, $post){
           return $user->id == $post->user_id; 
        });/*we are enabling the ability of updating a 
        blogpost('update-post'), the closure params are the user and post that
        we intend to verify*/


        Gate::define('delete-post',function($user, $post){
           return $user->id == $post->user_id; 
        });
        /**the before handler will run before both define handlers before it */
        Gate::before(function ($user, $ability) {
            if ($user->is_admin && in_array($ability, ['update-post'])) {
                return true;/*returns true for any authenticated admin user, if this returns
                false it checks above Gates. If i go to app and login under John Doe the only 
                admin user til now, i can update and delete posts not being the author of 
                blog posts.*/
            }
        });
//Check notebookII notes for below code which was done to demo after handler
        // Gate::after(function ($user, $ability, $result) {
        //     if ($user->is_admin) {
        //         return true;
        //     }
        // });

        
    }
}
