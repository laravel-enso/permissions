<?php

namespace LaravelEnso\PermissionManager;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\PermissionManager\app\Http\Middleware\VerifyRouteAccess;

class PermissionManagerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadDependencies();
        $this->registerMiddleware();
    }

    private function loadDependencies()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'laravel-enso/permissionmanager');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    private function registerMiddleware()
    {
        $this->app['router']->aliasMiddleware('verify-route-access', VerifyRouteAccess::class);
    }

    public function register()
    {
        $this->app->register(PermissionAuthServiceProvider::class);
    }
}
