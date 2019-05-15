<?php

namespace LaravelEnso\Permissions;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\Permissions\app\Http\Middleware\VerifyRouteAccess;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->addMiddleware()
            ->loadDependencies()
            ->publishDependencies();
    }

    private function addMiddleware()
    {
        $this->app['router']->aliasMiddleware(
            'verify-route-access', VerifyRouteAccess::class
        );

        return $this;
    }

    private function loadDependencies()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        return $this;
    }

    private function publishDependencies()
    {
        $this->publishes([
            __DIR__.'/database/factories' => database_path('factories'),
        ], 'permissions-factories');

        $this->publishes([
            __DIR__.'/database/factories' => database_path('factories'),
        ], 'enso-factories');
    }
}
