<?php

namespace LaravelEnso\Permissions\App\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\Menus\App\Models\Menu;
use LaravelEnso\Permissions\App\Enums\Types;
use LaravelEnso\Permissions\App\Exceptions\Permission as Exception;
use LaravelEnso\Roles\App\Models\Role;
use LaravelEnso\Roles\App\Traits\HasRoles;
use LaravelEnso\Tables\App\Traits\TableCache;
use LaravelEnso\Tutorials\App\Models\Tutorial;

class Permission extends Model
{
    use HasRoles, TableCache;

    protected $fillable = ['name', 'description', 'type', 'is_default'];

    protected $casts = ['is_default' => 'boolean'];

    public function menu()
    {
        return $this->hasOne(Menu::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function tutorials()
    {
        return $this->hasMany(Tutorial::class);
    }

    public function getIsReadAttribute()
    {
        return $this->type === Types::Read;
    }

    public function scopeImplicit($query)
    {
        return $query->whereIsDefault(true);
    }

    public function delete()
    {
        if ($this->roles()->exists()) {
            throw Exception::roles();
        }

        if ($this->menu()->exists()) {
            throw Exception::menu();
        }

        parent::delete();
    }
}
