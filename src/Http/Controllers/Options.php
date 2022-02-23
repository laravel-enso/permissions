<?php

namespace LaravelEnso\Permissions\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Permissions\Models\Permission;
use LaravelEnso\Select\Traits\OptionsBuilder;

class Options extends Controller
{
    use OptionsBuilder;

    protected $model = Permission::class;
}
