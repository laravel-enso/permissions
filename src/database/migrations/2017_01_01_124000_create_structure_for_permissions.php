<?php

use LaravelEnso\Migrator\App\Database\Migration;
use LaravelEnso\Permissions\App\Enums\Types;

class CreateStructureForPermissions extends Migration
{
    protected $permissions = [
        ['name' => 'system.permissions.index', 'description' => 'Permissions index', 'type' => Types::Read, 'is_default' => false],
        ['name' => 'system.permissions.create', 'description' => 'Create a new permission', 'type' => Types::Write, 'is_default' => false],
        ['name' => 'system.permissions.edit', 'description' => 'Edit existing permissions', 'type' => Types::Write, 'is_default' => false],
        ['name' => 'system.permissions.store', 'description' => 'Save edited permission', 'type' => Types::Write, 'is_default' => false],
        ['name' => 'system.permissions.update', 'description' => 'Update permission', 'type' => Types::Write, 'is_default' => false],
        ['name' => 'system.permissions.destroy', 'description' => 'Delete permission', 'type' => Types::Write, 'is_default' => false],
        ['name' => 'system.permissions.tableData', 'description' => 'Get table data for permissions', 'type' => Types::Read, 'is_default' => false],
        ['name' => 'system.permissions.exportExcel', 'description' => 'Export excel for permissions', 'type' => Types::Read, 'is_default' => false],
        ['name' => 'system.permissions.initTable', 'description' => 'Init table data for permissions', 'type' => Types::Read, 'is_default' => false],
    ];

    protected $menu = [
        'name' => 'Permissions', 'icon' => 'exclamation-triangle', 'route' => 'system.permissions.index', 'order_index' => 999, 'has_children' => false,
    ];

    protected $parentMenu = 'System';
}
