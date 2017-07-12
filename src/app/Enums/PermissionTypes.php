<?php

namespace LaravelEnso\PermissionManager\app\Enums;

use LaravelEnso\Helpers\Classes\AbstractEnum;

class PermissionTypes extends AbstractEnum
{
    public function __construct()
    {
        $this->data = [
            0 => __('Read'),
            1 => __('Write'),
        ];
    }
}
