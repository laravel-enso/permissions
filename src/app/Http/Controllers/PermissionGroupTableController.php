<?php

namespace LaravelEnso\PermissionManager\app\Http\Controllers;

use App\Http\Controllers\Controller;
use LaravelEnso\DataTable\app\Traits\DataTable;
use LaravelEnso\PermissionManager\app\DataTable\PermissionGroupsTableStructure;
use LaravelEnso\PermissionManager\app\Models\PermissionGroup;

class PermissionGroupTableController extends Controller
{
    use DataTable;

    protected $tableStructureClass = PermissionGroupsTableStructure::class;

    public function getTableQuery()
    {
        return PermissionGroup::select(\DB::raw('id as DT_RowId, name, description, created_at, updated_at'));
    }
}
