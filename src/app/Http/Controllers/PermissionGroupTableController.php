<?php

namespace LaravelEnso\PermissionManager\app\Http\Controllers;

use App\Http\Controllers\Controller;
use LaravelEnso\PermissionManager\app\Models\PermissionGroup;
use LaravelEnso\VueDatatable\app\Traits\Datatable;
use LaravelEnso\VueDatatable\app\Traits\Excel;

class PermissionGroupTableController extends Controller
{
    use Datatable, Excel;

    private const Template = __DIR__.'/../../Tables/permissionGroups.json';

    public function query()
    {
        return PermissionGroup::select(\DB::raw('id as dtRowId, name, description, created_at, updated_at'));
    }
}
