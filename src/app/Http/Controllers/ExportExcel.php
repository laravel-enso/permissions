<?php

namespace LaravelEnso\Permissions\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Tables\app\Traits\Excel;
use LaravelEnso\Permissions\app\Tables\Builders\PermissionTable;

class ExportExcel extends Controller
{
    use Excel;

    protected $tableClass = PermissionTable::class;
}
