<?php

namespace LaravelEnso\Permissions\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Permissions\app\Models\Permission;

class Destroy extends Controller
{
    public function __invoke(Permission $permission)
    {
        $permission->delete();

        return [
            'message' => __('The permission was successfully deleted'),
            'redirect' => 'system.permissions.index',
        ];
    }
}
