<?php

namespace LaravelEnso\PermissionManager\app\DataTable;

use LaravelEnso\DataTable\app\Classes\TableStructure;
use LaravelEnso\PermissionManager\app\Enums\PermissionTypes;

class PermissionsTableStructure extends TableStructure
{
    public function __construct()
    {
        $this->data = [
            'name' => __('Permissions'),
            'icon' => 'fa fa-exclamation-triangle',
            'crtNo' => __('#'),
            'actions' => __('Actions'),
            'actionButtons' => ['edit', 'destroy'],
            'headerButtons' => ['create', 'exportExcel'],
            'headerAlign' => 'center',
            'bodyAlign' => 'center',
            'render' => [2],
            'boolean' => [4],
            'enumMappings' => [
                'type' => PermissionTypes::class,
            ],
            'columns' => [
                0 => [
                    'label' => __('Name'),
                    'data' => 'name',
                    'name' => 'permissions.name',
                ],
                1 => [
                    'label' => __('Description'),
                    'data' => 'description',
                    'name' => 'permissions.description',
                ],
                2 => [
                    'label' => __('Type'),
                    'data' => 'type',
                    'name' => 'permissions.type',
                ],
                3 => [
                    'label' => __('Group'),
                    'data' => 'groupName',
                    'name' => 'permission_groups.name',
                ],
                4 => [
                    'label' => __('Default Access'),
                    'data' => 'default',
                    'name' => 'permissions.default',
                ],
                5 => [
                    'label' => __('Created At'),
                    'data' => 'created_at',
                    'name' => 'permissions.created_at',
                ],
                6 => [
                    'label' => __('Updated At'),
                    'data' => 'updated_at',
                    'name' => 'permissions.updated_at',
                ],
            ],
        ];
    }
}
