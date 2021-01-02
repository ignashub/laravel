<?php

namespace App\Providers;

use App\Policies\PostPolicy;
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
        \App\Post::class => PostPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-post', function ($user, $post) {
            if($user->is_admin == 1 ){
                return true;
            }
            return $user->id === $post->user_id;
        });

        Gate::define('create-post', function ($user) {
            return $user->id != null;
        });
        Gate::define('super_user', function ($user){
            return $user->is_admin;
        });
    }
}
