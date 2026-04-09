<?php

namespace LaravelEnso\Permissions\State;

use Illuminate\Support\Facades\Auth;
use LaravelEnso\Core\Contracts\ProvidesState;

class DefaultRoute implements ProvidesState
{
    public function store(): string
    {
        return 'app';
    }

    public function state(): array
    {
        return ['defaultRoute' => Auth::user()->role->menu->permission->name];
    }
}
