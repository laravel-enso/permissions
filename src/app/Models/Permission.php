<?php

namespace LaravelEnso\PermissionManager\app\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\RoleManager\app\Models\Role;
use LaravelEnso\RoleManager\app\Traits\HasRoles;
use LaravelEnso\TutorialManager\app\Models\Tutorial;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class Permission extends Model
{
    use HasRoles;

    protected $fillable = [
        'permission_group_id', 'name', 'description', 'type', 'is_default',
    ];

    protected $casts = ['is_default' => 'boolean'];

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
        return $this->roles()->pluck('id');
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
        return $query->whereIsDefault(true);
    }

    public function delete()
    {
        if ($this->roles()->count()) {
            throw new ConflictHttpException(__(
                'Operation failed because the permission is allocated to existing role(s)'
            ));
        }

        parent::delete();
    }
}
