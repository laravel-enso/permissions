<?php

namespace LaravelEnso\Permissions\State;

use Illuminate\Support\Facades\Auth;
use LaravelEnso\Core\Contracts\ProvidesState;

class DefaultRoute implements ProvidesState
{
    public function mutation(): string
    {
        return 'setDefaultRoute';
    }

    public function state(): mixed
    {
        return Auth::user()->role->menu->permission->name;
    }
}
