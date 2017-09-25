<?php

namespace LaravelEnso\PermissionManager\app\Http\Controllers;

use App\Http\Controllers\Controller;
use LaravelEnso\DataTable\app\Traits\DataTable;
use LaravelEnso\PermissionManager\app\DataTable\PermissionsTableStructure;
use LaravelEnso\PermissionManager\app\Models\Permission;

class PermissionTableController extends Controller
{
    use DataTable;

    protected $tableStructureClass = PermissionsTableStructure::class;

    public function getTableQuery()
    {
        return Permission::select(\DB::raw('permissions.id as DT_RowId, permissions.name,
            permissions.description, permissions.type, permissions.created_at,
            permissions.updated_at, permission_groups.name as groupName, permissions.`default`')
        )->join('permission_groups', 'permissions.permission_group_id', '=', 'permission_groups.id');
    }
}
