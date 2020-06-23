<?php

namespace LaravelEnso\Permissions;

use LaravelEnso\Enums\EnumServiceProvider as ServiceProvider;
use LaravelEnso\Permissions\Enums\Types;

class EnumServiceProvider extends ServiceProvider
{
    public $register = [
        'permissionTypes' => Types::class,
    ];
}
