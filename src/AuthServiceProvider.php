<?php

namespace LaravelEnso\PermissionManager;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        \Gate::define('access-route', function ($user, $route) {
            return !is_null(
                $user->role->permissions()
                    ->whereName($route)
                    ->first()
            );
        });
    }
}
