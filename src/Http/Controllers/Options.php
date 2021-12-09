<?php

namespace LaravelEnso\Permissions\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Permissions\Models\Permission;
use LaravelEnso\Select\Traits\OptionsBuilder;
use LaravelEnso\UserGroups\Models\UserGroup;

class Options extends Controller
{
    use OptionsBuilder;

    protected $model = Permission::class;
}
