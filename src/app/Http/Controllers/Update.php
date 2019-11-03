<?php

namespace LaravelEnso\Permissions\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Permissions\app\Http\Requests\ValidatePermissionRequest;
use LaravelEnso\Permissions\app\Models\Permission;

class Update extends Controller
{
    public function __invoke(ValidatePermissionRequest $request, Permission $permission)
    {
        $permission->updateWithRoles($request->validated());

        return ['message' => __('The permission was successfully updated')];
    }
}
