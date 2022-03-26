<?php

namespace LaravelEnso\Permissions;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::define(
            'access-route',
            fn ($user, $route) => $user->canAccess($route)
        );
    }
}
