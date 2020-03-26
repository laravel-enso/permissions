<?php

namespace LaravelEnso\Permissions\App\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Permissions\App\Tables\Builders\PermissionTable;
use LaravelEnso\Tables\App\Traits\Init;

class InitTable extends Controller
{
    use Init;

    protected $tableClass = PermissionTable::class;
}
