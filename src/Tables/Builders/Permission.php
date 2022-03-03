<?php

namespace LaravelEnso\Permissions\Tables\Builders;

use Illuminate\Database\Eloquent\Builder;
use LaravelEnso\Permissions\Models\Permission as Model;
use LaravelEnso\Tables\Contracts\Table;

class Permission implements Table
{
    private const TemplatePath = __DIR__.'/../Templates/permissions.json';

    public function query(): Builder
    {
        return Model::with('menu:permission_id')->selectRaw('
            permissions.id, permissions.name, permissions.description,
            permissions.created_at, permissions.is_default
        ');
    }

    public function templatePath(): string
    {
        return self::TemplatePath;
    }
}
