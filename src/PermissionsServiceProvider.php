<?php

namespace LaravelEnso\PermissionManager;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\PermissionManager\app\Http\Middleware\VerifyRouteAccess;

class PermissionsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app['router']->aliasMiddleware('verify-route-access', VerifyRouteAccess::class);
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'laravel-enso/permissionmanager');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    public function register()
    {
        //
    }
}
