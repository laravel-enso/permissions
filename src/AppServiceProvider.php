<?php

namespace LaravelEnso\PermissionManager;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\PermissionManager\app\Http\Middleware\VerifyRouteAccess;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app['router']->aliasMiddleware('verify-route-access', VerifyRouteAccess::class);

        $this->load();

        $this->publish();
    }

    private function load()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->mergeConfigFrom(__DIR__.'/config/resource-permissions.php', 'resource-permissions');
    }

    private function publish()
    {
        $this->publishes([
            __DIR__.'/resources/js' => resource_path('js'),
        ], 'permissions-assets');

        $this->publishes([
            __DIR__.'/resources/js' => resource_path('js'),
        ], 'enso-assets');
    }

    public function register()
    {
        $this->app->register(AuthServiceProvider::class);
    }
}
