<?php

namespace LaravelEnso\PermissionManager\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\VueDatatable\app\Traits\Excel;
use LaravelEnso\VueDatatable\app\Traits\Datatable;
use LaravelEnso\PermissionManager\app\Tables\Builders\PermissionTable;

class PermissionTableController extends Controller
{
    use Datatable, Excel;

    protected $tableClass = PermissionTable::class;
}
