<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForPermissions extends StructureMigration
{
    protected $permissionGroup = [
        'name' => 'system.permissions', 'description' => 'Permissions group',
    ];

    protected $permissions = [
        ['name' => 'system.permissions.index', 'description' => 'Permissions index', 'type' => 0, 'is_default' => false],
        ['name' => 'system.permissions.create', 'description' => 'Create a new permission', 'type' => 1, 'is_default' => false],
        ['name' => 'system.permissions.edit', 'description' => 'Edit existing permissions', 'type' => 1, 'is_default' => false],
        ['name' => 'system.permissions.store', 'description' => 'Save edited permission', 'type' => 1, 'is_default' => false],
        ['name' => 'system.permissions.update', 'description' => 'Update permission', 'type' => 1, 'is_default' => false],
        ['name' => 'system.permissions.destroy', 'description' => 'Delete permission', 'type' => 1, 'is_default' => false],
        ['name' => 'system.permissions.getTableData', 'description' => 'Get table data for permissions', 'type' => 0, 'is_default' => false],
        ['name' => 'system.permissions.exportExcel', 'description' => 'Export excel for permissions', 'type' => 0, 'is_default' => false],
        ['name' => 'system.permissions.initTable', 'description' => 'Init table data for permissions', 'type' => 0, 'is_default' => false],
        ['name' => 'system.resourcePermissions.create', 'description' => 'Create permissions for a resource controller', 'type' => 1, 'is_default' => false],
        ['name' => 'system.resourcePermissions.store', 'description' => 'Store resource permissions', 'type' => 1, 'is_default' => false],
    ];

    protected $menu = [
        'name' => 'Permissions', 'icon' => 'exclamation-triangle', 'link' => 'system.permissions.index', 'order_index' => 999, 'has_children' => false,
    ];

    protected $parentMenu = 'System';
}
