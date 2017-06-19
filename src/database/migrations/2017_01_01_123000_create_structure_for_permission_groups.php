<?php

use LaravelEnso\Core\app\Classes\StructureManager\StructureMigration;

class CreateStructureForPermissionGroups extends StructureMigration
{
    protected $permissionGroup = [
        'name' => 'system.permissionGroups', 'description' => 'Permission Groups Group',
    ];

    protected $permissions = [
        ['name' => 'system.permissionGroups.index', 'description' => 'Permission Groups Index', 'type' => 0, 'default' => false],
        ['name' => 'system.permissionGroups.create', 'description' => 'Create Permission Group', 'type' => 1, 'default' => false],
        ['name' => 'system.permissionGroups.edit', 'description' => 'Edit Existing Permission Group', 'type' => 1, 'default' => false],
        ['name' => 'system.permissionGroups.store', 'description' => 'Save Permission Group', 'type' => 1, 'default' => false],
        ['name' => 'system.permissionGroups.update', 'description' => 'Update Permission Group', 'type' => 1, 'default' => false],
        ['name' => 'system.permissionGroups.destroy', 'description' => 'Delete Permission Group', 'type' => 1, 'default' => false],
        ['name' => 'system.permissionGroups.getTableData', 'description' => 'Get table data for Permission Groups', 'type' => 0, 'default' => false],
        ['name' => 'system.permissionGroups.initTable', 'description' => 'Init table data for Permission Groups', 'type' => 0, 'default' => false],
    ];

    protected $menu = [
        'name' => 'Permission Groups', 'icon' => 'fa fa-fw fa-object-group', 'link' => 'system/permissionGroups', 'has_children' => 0,
    ];

    protected $parentMenu = 'System';
}
