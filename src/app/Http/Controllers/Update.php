<?php

namespace LaravelEnso\Permissions\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Permissions\app\Models\Permission;
use LaravelEnso\Permissions\app\Http\Requests\ValidatePermissionRequest;

class Update extends Controller
{
    public function __invoke(ValidatePermissionRequest $request, Permission $permission)
    {
        $permission->updateWithRoles($request->validated());

        return ['message' => __('The permission was successfully updated')];
    }
}
