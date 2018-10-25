<?php

namespace LaravelEnso\PermissionManager\app\Tables\Builders;

use LaravelEnso\VueDatatable\app\Classes\Table;
use LaravelEnso\PermissionManager\app\Models\Permission;

class PermissionTable extends Table
{
    protected $templatePath = __DIR__.'/../Templates/permissions.json';

    public function query()
    {
        return Permission::select(\DB::raw('
            permissions.id as "dtRowId", permissions.name, permissions.description,
            permissions.type, permissions.created_at, permissions.is_default
        '));
    }
}
