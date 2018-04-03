<?php

namespace LaravelEnso\PermissionManager\app\Http\Controllers;

use App\Http\Controllers\Controller;
use LaravelEnso\VueDatatable\app\Traits\Excel;
use LaravelEnso\VueDatatable\app\Traits\Datatable;
use LaravelEnso\PermissionManager\app\Tables\Builders\PermissionGroupTable;

class PermissionGroupTableController extends Controller
{
    use Datatable, Excel;

    protected $tableClass = PermissionGroupTable::class;
}
