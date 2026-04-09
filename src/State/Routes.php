<?php

namespace LaravelEnso\Permissions\State;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use LaravelEnso\Core\Contracts\ProvidesState;

class Routes implements ProvidesState
{
    public function store(): string
    {
        return 'app';
    }

    public function state(): array
    {
        return ['routes' => $this->routes()->toArray()];
    }

    protected function routes(): Collection
    {
        return Auth::user()->role->permissions
            ->mapWithKeys(fn ($permission) => [
                $permission->name => $this->route($permission->name),
            ])->merge(['login' => $this->route('login')]);
    }

    protected function route(string $name): ?array
    {
        $route = Route::getRoutes()->getByName($name);

        return $route
            ? (new Collection($route))->only(['uri', 'methods'])
            ->put('domain', $route->domain())
            ->toArray()
            : null;
    }
}
