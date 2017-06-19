<?php

use LaravelEnso\Core\app\Classes\StructureManager\StructureMigration;

class CreateStructureForPermissionGroups extends StructureMigration
{
    protected $permissionGroup = [
        'name' => 'system.permissionGroups', 'description' => 'Permission Groups Group',
    ];

    protected $permissions = [
        ['name' => 'system.permissionGroups.index', 'description' => 'Permissions Groups Index', 'type' => 0],
        ['name' => 'system.permissionGroups.create', 'description' => 'Create Permissions Group', 'type' => 1],
        ['name' => 'system.permissionGroups.edit', 'description' => 'Edit Existing Permissions Group', 'type' => 1],
        ['name' => 'system.permissionGroups.store', 'description' => 'Save Permissions Group', 'type' => 1],
        ['name' => 'system.permissionGroups.update', 'description' => 'Update Permissions Group', 'type' => 1],
        ['name' => 'system.permissionGroups.destroy', 'description' => 'Delete Permissions Group', 'type' => 1],
        ['name' => 'system.permissionGroups.getTableData', 'description' => 'Get table data for permissionsgroups', 'type' => 0],
        ['name' => 'system.permissionGroups.initTable', 'description' => 'Init table data for permissiongroups', 'type' => 0],
    ];

    protected $menu = [
        'name' => 'Permission Groups', 'icon' => 'fa fa-fw fa-object-group', 'link' => 'system/permissionGroups', 'has_children' => 0,
    ];

    protected $parentMenu = 'System';
}
