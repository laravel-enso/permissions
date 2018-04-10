<?php

namespace LaravelEnso\PermissionManager\app\Enums;

use LaravelEnso\Helpers\app\Classes\Enum;

class ResourcePermissions extends Enum
{
    protected static function attributes()
    {
        return config('resource-permissions');
    }
}
