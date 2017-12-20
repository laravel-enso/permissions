<?php

namespace LaravelEnso\PermissionManager\app\Http\Controllers;

use App\Http\Controllers\Controller;
use LaravelEnso\VueDatatable\app\Traits\Excel;
use LaravelEnso\VueDatatable\app\Traits\Datatable;
use LaravelEnso\PermissionManager\app\Models\Permission;

class PermissionTableController extends Controller
{
    use Datatable, Excel;

    private const Template = __DIR__.'/../../Tables/permissions.json';

    public function query()
    {
        return Permission::select(\DB::raw(
            'permissions.id as dtRowId, permissions.name,
            permissions.description, permissions.type, permissions.created_at, permissions.updated_at,
            permission_groups.name as groupName, permissions.`default`'
        ))->join('permission_groups', 'permissions.permission_group_id', '=', 'permission_groups.id');
    }
}
