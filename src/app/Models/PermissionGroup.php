<?php

namespace LaravelEnso\PermissionManager\app\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class PermissionGroup extends Model
{
    protected $fillable = ['name', 'description'];

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

    public function delete()
    {
        if ($this->permissions()->count()) {
            throw new ConflictHttpException(__('The permission group cannot be deleted because it has child permissions'));
        }

        parent::delete();
    }
}
