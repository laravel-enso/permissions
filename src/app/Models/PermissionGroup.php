<?php

namespace LaravelEnso\PermissionManager\app\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\DbSyncMigrations\app\Traits\DbSyncMigrations;

class PermissionGroup extends Model
{
    use DbSyncMigrations;

    protected $fillable = ['name', 'description'];

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
