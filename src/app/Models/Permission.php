<?php

namespace LaravelEnso\PermissionManager\app\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['permission_group_id', 'name', 'description', 'type', 'default'];
    protected $attributes = ['default' => 0];

    public function permissions_group()
    {
        return $this->belongsTo('LaravelEnso\PermissionManager\app\Models\PermissionGroup');
    }

    public function roles()
    {
        return $this->belongsToMany('LaravelEnso\Core\app\Models\Role')->withTimestamps();
    }

    public function getRolesListAttribute()
    {
        return $this->roles->pluck('id')->toArray();
    }

    public function tutorials()
    {
        return $this->hasMany('LaravelEnso\TutorialManager\app\Models\Tutorial');
    }
}
