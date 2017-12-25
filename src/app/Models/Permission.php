<?php

namespace LaravelEnso\PermissionManager\app\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\RoleManager\app\Models\Role;
use LaravelEnso\TutorialManager\app\Models\Tutorial;
use LaravelEnso\DbSyncMigrations\app\Traits\DbSyncMigrations;

class Permission extends Model
{
    use DbSyncMigrations;

    protected $fillable = ['permission_group_id', 'name', 'description', 'type', 'default'];

    protected $attributes = ['default' => false];

    protected $casts = ['default' => 'boolean'];

    public function permission_group()
    {
        return $this->belongsTo(PermissionGroup::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function getRoleListAttribute()
    {
        return $this->roles->pluck('id')->toArray();
    }

    public function tutorials()
    {
        return $this->hasMany(Tutorial::class);
    }

    public function getIsReadAttribute()
    {
        return $this->type === 0;
    }

    public function scopeImplicit($query)
    {
        return $query->whereDefault(true);
    }
}
