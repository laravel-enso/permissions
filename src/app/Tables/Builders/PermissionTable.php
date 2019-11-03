<?php

namespace LaravelEnso\Permissions\app\Tables\Builders;

use Illuminate\Database\Eloquent\Builder;
use LaravelEnso\Permissions\app\Models\Permission;
use LaravelEnso\Tables\app\Contracts\Table;

class PermissionTable implements Table
{
    protected const TemplatePath = __DIR__.'/../Templates/permissions.json';

    public function query(): Builder
    {
        return Permission::selectRaw('
            permissions.id, permissions.name, permissions.description,
            permissions.type, permissions.created_at, permissions.is_default
        ');
    }

    public function templatePath(): string
    {
        return static::TemplatePath;
    }
}
