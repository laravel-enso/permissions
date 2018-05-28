<?php

return [
    'resource' => [
        ['name' => 'index', 'type' => 0, 'permission_group_id' => null, 'description' => 'Show index for ', 'is_default' => false],
        ['name' => 'create', 'type' => 0, 'permission_group_id' => null, 'description' => 'Create ', 'is_default' => false],
        ['name' => 'store', 'type' => 1, 'permission_group_id' => null, 'description' => 'Store a newly created ', 'is_default' => false],
        ['name' => 'show', 'type' => 0, 'permission_group_id' => null, 'description' => 'Show ', 'is_default' => false],
        ['name' => 'edit', 'type' => 0, 'permission_group_id' => null, 'description' => 'Edit existing ', 'is_default' => false],
        ['name' => 'update', 'type' => 1, 'permission_group_id' => null, 'description' => 'Update edited ', 'is_default' => false],
        ['name' => 'destroy', 'type' => 1, 'permission_group_id' => null, 'description' => 'Delete ', 'is_default' => false],
    ],
    'dataTables' => [
        ['name' => 'initTable', 'type' => 0, 'permission_group_id' => null, 'description' => 'Init table for ', 'is_default' => false],
        ['name' => 'getTableData', 'type' => 0, 'permission_group_id' => null, 'description' => 'Get table data for ', 'is_default' => false],
        ['name' => 'exportExcel', 'type' => 0, 'permission_group_id' => null, 'description' => 'Export excel for  ', 'is_default' => false],
    ],
    'vueSelect' => [
        ['name' => 'selectOptions', 'type' => 0, 'permission_group_id' => null, 'description' => 'Get vue-select options for  ', 'is_default' => false],
    ],
];
