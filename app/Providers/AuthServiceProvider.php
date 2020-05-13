<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\PostPolicy;
use App\Post;
use App\Policies\RolePolicy;
use App\Role;

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
        Role::class => RolePolicy::class,
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

        // Category Gates

        Gate::define('create-category', function ($user) {
            return $user->admin;
        });

        Gate::define('delete-category', function ($user, $category) {
            return $user->id === $category->user_id;
        });

        Gate::define('update-category', function ($user, $category) {
            return $user->id === $category->user_id;
        });

        // Product Gates

        Gate::define('create-product', function ($user) {
            return $user->admin;
        });

        Gate::define('delete-product', function ($user, $product) {
            return $user->id === $product->user_id;
        });

        Gate::define('update-product', function ($user, $product) {
            return $user->id === $product->user_id;
        });
    }
}
