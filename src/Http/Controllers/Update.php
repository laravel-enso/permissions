<?php

namespace LaravelEnso\Permissions\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Permissions\Http\Requests\ValidatePermissionRequest;
use LaravelEnso\Permissions\Models\Permission;

class Update extends Controller
{
    public function __invoke(ValidatePermissionRequest $request, Permission $permission)
    {
        $permission->updateWithRoles(
            $request->validatedExcept('roles'),
            $request->get('roles')
        );

        return ['message' => __('The permission was successfully updated')];
    }
}
