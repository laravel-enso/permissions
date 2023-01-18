<?php

namespace LaravelEnso\Permissions\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use LaravelEnso\DynamicMethods\Traits\Abilities;
use LaravelEnso\Menus\Models\Menu;
use LaravelEnso\Permissions\Enums\Type;
use LaravelEnso\Permissions\Exceptions\Permission as Exception;
use LaravelEnso\Roles\Traits\HasRoles;
use LaravelEnso\Tables\Traits\TableCache;

class Permission extends Model
{
    use Abilities, HasRoles, HasFactory, TableCache;

    protected $guarded = ['id'];

    protected $casts = [
        'is_default' => 'boolean',
        'type' => Type::class,
    ];

    public function menu()
    {
        return $this->hasOne(Menu::class);
    }

    public function getTypeAttribute()
    {
        return $this->type();
    }

    public function type(): Type
    {
        if ($this->relationLoaded('menu') && $this->menu !== null) {
            return Type::Menu;
        }

        return Type::type($this->method());
    }

    public function method()
    {
        $methods = Route::getRoutes()->getByName($this->name)?->methods();

        return $methods[0] ?? null;
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
