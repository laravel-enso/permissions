<?php

namespace LaravelEnso\Permissions\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Tables\app\Traits\Data;
use LaravelEnso\Permissions\app\Tables\Builders\PermissionTable;

class TableData extends Controller
{
    use Data;

    protected $tableClass = PermissionTable::class;
}
