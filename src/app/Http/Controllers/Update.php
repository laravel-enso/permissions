<?php

namespace LaravelEnso\Permissions\App\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Permissions\App\Http\Requests\ValidatePermissionRequest;
use LaravelEnso\Permissions\App\Models\Permission;

class Update extends Controller
{
    public function __invoke(ValidatePermissionRequest $request, Permission $permission)
    {
        $permission->updateWithRoles($request->validated());

        return ['message' => __('The permission was successfully updated')];
    }
}
