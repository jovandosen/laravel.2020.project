<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\PostPolicy;
use App\Post;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Post Gates

        Gate::define('update-post', function ($user, $post) {
            return $user->id === $post->userID;
        });

        Gate::define('delete-post', function ($user, $post) {
            return $user->id === $post->userID;
        });

        Gate::define('create-post', function ($user) {
            return $user->admin;
        });

        // Movie Gates

        Gate::define('update-movie', function ($user, $movie) {
            return $user->id === $movie->user_id;
        });

        Gate::define('delete-movie', function ($user, $movie) {
            return $user->id === $movie->user_id;
        });

        Gate::define('create-movie', function ($user) {
            return $user->admin;
        });

        // Genre Gates

        Gate::define('create-genre', function ($user) {
            return $user->admin;
        });

        Gate::define('delete-genre', function ($user, $genre) {
            return $user->id === $genre->user_id;
        });

        Gate::define('update-genre', function ($user, $genre) {
            return $user->id === $genre->user_id;
        });
    }
}
