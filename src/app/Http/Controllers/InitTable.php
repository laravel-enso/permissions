<?php

namespace LaravelEnso\Permissions\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Tables\app\Traits\Init;
use LaravelEnso\Permissions\app\Tables\Builders\PermissionTable;

class InitTable extends Controller
{
    use Init;

    protected $tableClass = PermissionTable::class;
}
