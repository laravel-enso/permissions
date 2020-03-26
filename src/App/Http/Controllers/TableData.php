<?php

namespace LaravelEnso\Permissions\App\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Permissions\App\Tables\Builders\PermissionTable;
use LaravelEnso\Tables\App\Traits\Data;

class TableData extends Controller
{
    use Data;

    protected $tableClass = PermissionTable::class;
}
