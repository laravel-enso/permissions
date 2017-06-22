<?php

namespace LaravelEnso\PermissionManager\app\DataTable;

use LaravelEnso\Core\app\Enums\IsActiveEnum;
use LaravelEnso\DataTable\app\Classes\TableStructure;
use LaravelEnso\PermissionManager\app\Enums\PermissionTypes;

class PermissionsTableStructure extends TableStructure
{
    public function __construct()
    {
        $this->data = [
            'crtNo'         => __('#'),
            'actionButtons' => __('Actions'),
            'render'        => [3, 5],
            'headerAlign'   => 'center',
            'bodyAlign'     => 'center',
            'enumMappings'  => [
                'type'    => PermissionTypes::class,
                'default' => IsActiveEnum::class,
            ],
            'render'          => [2, 4],
            'columns'         => [
                0 => [
                    'label' => __('Name'),
                    'data'  => 'name',
                    'name'  => 'permissions.name',
                ],
                1 => [
                    'label' => __('Description'),
                    'data'  => 'description',
                    'name'  => 'permissions.description',
                ],
                2 => [
                    'label' => __('Type'),
                    'data'  => 'type',
                    'name'  => 'type',
                ],
                3 => [
                    'label' => __('Group'),
                    'data'  => 'grup',
                    'name'  => 'permission_groups.name',
                ],
                4 => [
                    'label' => __('Default Access'),
                    'data'  => 'default',
                    'name'  => 'permissions.default',
                ],
                5 => [
                    'label' => __('Created At'),
                    'data'  => 'created_at',
                    'name'  => 'permissions.created_at',
                ],
                6 => [
                    'label' => __('Updated At'),
                    'data'  => 'updated_at',
                    'name'  => 'permissions.updated_at',
                ],
            ],
        ];
    }
}
