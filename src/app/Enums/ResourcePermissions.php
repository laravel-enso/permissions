<?php

namespace LaravelEnso\PermissionManager\app\Enums;

use LaravelEnso\Helpers\Classes\AbstractEnum;

class ResourcePermissions extends AbstractEnum
{
    public function __construct()
    {
        $this->data = [
            'resource'   => [
                ['name' => 'index', 'type' => 0, 'permission_group_id' => null],
                ['name' => 'create', 'type' => 0, 'permission_group_id' => null],
                ['name' => 'store', 'type' => 1, 'permission_group_id' => null],
                ['name' => 'show', 'type' => 0, 'permission_group_id' => null],
                ['name' => 'edit', 'type' => 0, 'permission_group_id' => null],
                ['name' => 'update', 'type' => 1, 'permission_group_id' => null],
                ['name' => 'destroy', 'type' => 1, 'permission_group_id' => null],
            ],
            'dataTables' => [
                ['name' => 'initTable', 'type' => 0, 'permission_group_id' => null],
                ['name' => 'getTableData', 'type' => 0, 'permission_group_id' => null],
            ],
            'vueSelect'  => [
                ['name' => 'getOptionsList', 'type' => 0, 'permission_group_id' => null],
            ],
        ];
    }
}
