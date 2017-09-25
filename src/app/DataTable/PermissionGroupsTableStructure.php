<?php

namespace LaravelEnso\PermissionManager\app\DataTable;

use LaravelEnso\DataTable\app\Classes\TableStructure;

class PermissionGroupsTableStructure extends TableStructure
{
    public function __construct()
    {
        $this->data = [
            'name'          => __('Permissions Groups'),
            'icon'          => 'fa fa-object-group',
            'crtNo'         => __('#'),
            'actions'       => __('Actions'),
            'actionButtons' => ['edit', 'destroy'],
            'headerButtons' => ['create', 'exportExcel'],
            'headerAlign'   => 'center',
            'bodyAlign'     => 'center',
            'columns'       => [
                0 => [
                    'label' => __('Name'),
                    'data'  => 'name',
                    'name'  => 'name',
                ],
                1 => [
                    'label' => __('Description'),
                    'data'  => 'description',
                    'name'  => 'description',
                ],
                2 => [
                    'label' => __('Created At'),
                    'data'  => 'created_at',
                    'name'  => 'created_at',
                ],
                3 => [
                    'label' => __('Updated At'),
                    'data'  => 'updated_at',
                    'name'  => 'updated_at',
                ],
            ],
        ];
    }
}
