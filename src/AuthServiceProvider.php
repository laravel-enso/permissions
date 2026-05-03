<?php

namespace LaravelEnso\Permissions;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use LaravelEnso\Users\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::define(
            'access-route',
            fn (User $user, $route) => $user->canAccess($route)
        );
    }
}
