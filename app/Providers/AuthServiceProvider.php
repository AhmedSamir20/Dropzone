<?php

namespace App\Providers;

use App\Models\Image;
use App\Models\Post;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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

        Gate::define('upload-image', function (User $user, Post $post) {
            return $user->id === $post->user_id;
        });

        Gate::define('delete-image', function (User $user, Image $image) {
            $post= Post::find($image->post_id);
            return $user->id === $post->user_id;
        });
    }
}
