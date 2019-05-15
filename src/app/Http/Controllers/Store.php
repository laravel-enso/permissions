<?php

namespace LaravelEnso\Permissions\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Permissions\app\Models\Permission;
use LaravelEnso\Permissions\app\Http\Requests\ValidatePermissionStore;

class Store extends Controller
{
    public function __invoke(ValidatePermissionStore $request, Permission $permission)
    {
        $permission = $permission->storeWithRoles($request->validated());

        return [
            'message' => __('The permission was created!'),
            'redirect' => 'system.permissions.edit',
            'param' => ['permission' => $permission->id],
        ];
    }
}
