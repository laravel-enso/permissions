<?php

namespace LaravelEnso\Permissions\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Permissions\Tables\Builders\PermissionTable;
use LaravelEnso\Tables\Traits\TableBuilder;

class Table extends Controller
{
    use TableBuilder;

    protected $tableClass = PermissionTable::class;
}
