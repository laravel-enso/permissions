<?php

namespace LaravelEnso\PermissionManager\app\Enums;

use LaravelEnso\Helpers\Classes\Enum;

class ResourcePermissions extends Enum
{
    public function __construct()
    {
        parent::__construct('resource-permissions');
    }
}