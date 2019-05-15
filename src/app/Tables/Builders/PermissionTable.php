<?php

namespace LaravelEnso\Permissions\app\Tables\Builders;

use LaravelEnso\Tables\app\Services\Table;
use LaravelEnso\Permissions\app\Models\Permission;

class PermissionTable extends Table
{
    protected $templatePath = __DIR__.'/../Templates/permissions.json';

    public function query()
    {
        return Permission::selectRaw('
            permissions.id as "dtRowId", permissions.name, permissions.description,
            permissions.type, permissions.created_at, permissions.is_default
        ');
    }
}
