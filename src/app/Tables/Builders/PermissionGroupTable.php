<?php

namespace LaravelEnso\PermissionManager\app\Tables\Builders;

use LaravelEnso\VueDatatable\app\Classes\Table;
use LaravelEnso\PermissionManager\app\Models\PermissionGroup;

class PermissionGroupTable extends Table
{
    protected $templatePath = __DIR__.'/../Templates/permissionGroups.json';

    public function query()
    {
        return PermissionGroup::select(\DB::raw('
            id as "dtRowId", name, description, created_at, updated_at
        '));
    }
}
