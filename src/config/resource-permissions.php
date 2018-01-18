<?php

return [
    'resource' => [
        ['name' => 'index', 'type' => 0, 'permission_group_id' => null, 'description' => 'Show index for '],
        ['name' => 'create', 'type' => 0, 'permission_group_id' => null, 'description' => 'Create '],
        ['name' => 'store', 'type' => 1, 'permission_group_id' => null, 'description' => 'Store a newly created '],
        ['name' => 'show', 'type' => 0, 'permission_group_id' => null, 'description' => 'Show '],
        ['name' => 'edit', 'type' => 0, 'permission_group_id' => null, 'description' => 'Edit existing '],
        ['name' => 'update', 'type' => 1, 'permission_group_id' => null, 'description' => 'Update edited '],
        ['name' => 'destroy', 'type' => 1, 'permission_group_id' => null, 'description' => 'Delete '],
    ],
    'dataTables' => [
        ['name' => 'initTable', 'type' => 0, 'permission_group_id' => null, 'description' => 'Init table for '],
        ['name' => 'getTableData', 'type' => 0, 'permission_group_id' => null, 'description' => 'Get table data for '],
        ['name' => 'exportExcel', 'type' => 0, 'permission_group_id' => null, 'description' => 'Export excel for  '],
    ],
    'vueSelect' => [
        ['name' => 'selectOptions', 'type' => 0, 'permission_group_id' => null, 'description' => 'Get vue-select options for  '],
    ],
];
