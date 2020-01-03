<?php

namespace LaravelEnso\Permissions;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\Permissions\App\Http\Middleware\VerifyRouteAccess;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app['router']->aliasMiddleware(
            'verify-route-access', VerifyRouteAccess::class
        );

        $this->load()
            ->publish();
    }

    private function load()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        return $this;
    }

    private function publish()
    {
        $this->publishes([
            __DIR__.'/database/factories' => database_path('factories'),
        ], ['permissions-factories', 'enso-factories']);
    }
}
