<?php

namespace LaravelEnso\Permissions\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Tables\app\Traits\Excel;
use LaravelEnso\Tables\app\Traits\Datatable;
use LaravelEnso\Permissions\app\Tables\Builders\PermissionTable;

class Table extends Controller
{
    use Datatable, Excel;

    protected $tableClass = PermissionTable::class;
}
