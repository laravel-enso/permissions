<?php

namespace LaravelEnso\PermissionManager\app\Http\Controllers;

use App\Http\Controllers\Controller;
use LaravelEnso\PermissionManager\app\Models\Permission;
use LaravelEnso\PermissionManager\app\Http\Services\PermissionService;
use LaravelEnso\PermissionManager\app\Http\Requests\ValidatePermissionRequest;

class PermissionController extends Controller
{
    public function create(PermissionService $service)
    {
        return $service->create();
    }

    public function store(ValidatePermissionRequest $request, Permission $permission, PermissionService $service)
    {
        return $service->store($request, $permission);
    }

    public function edit(Permission $permission, PermissionService $service)
    {
        return $service->edit($permission);
    }

    public function update(ValidatePermissionRequest $request, Permission $permission, PermissionService $service)
    {
        return $service->update($request, $permission);
    }

    public function destroy(Permission $permission, PermissionService $service)
    {
        return $service->destroy($permission);
    }
}
