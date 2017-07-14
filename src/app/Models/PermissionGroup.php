<?php

namespace LaravelEnso\PermissionManager\app\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\DbSyncMigrations\app\Traits\DbSyncMigrations;
use LaravelEnso\Helpers\Traits\FormattedTimestamps;

class PermissionGroup extends Model
{
    use FormattedTimestamps, DbSyncMigrations;

    protected $fillable = ['name', 'description'];

    public function permissions()
    {
        return $this->hasMany('LaravelEnso\PermissionManager\app\Models\Permission');
    }
}
