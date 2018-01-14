<?php

namespace LaravelEnso\PermissionManager\app\Http\Controllers;

use App\Http\Controllers\Controller;
use LaravelEnso\PermissionManager\app\Models\PermissionGroup;
use LaravelEnso\PermissionManager\app\Http\Services\PermissionGroupService;
use LaravelEnso\PermissionManager\app\Http\Requests\ValidatePermissionGroupRequest;

class PermissionGroupController extends Controller
{
    public function create(PermissionGroupService $service)
    {
        return $service->create();
    }

    public function store(ValidatePermissionGroupRequest $request, PermissionGroup $permissionGroup, PermissionGroupService $service)
    {
        return $service->store($request, $permissionGroup);
    }

    public function edit(PermissionGroup $permissionGroup, PermissionGroupService $service)
    {
        return $service->edit($permissionGroup);
    }

    public function update(ValidatePermissionGroupRequest $request, PermissionGroup $permissionGroup, PermissionGroupService $service)
    {
        return $service->update($request, $permissionGroup);
    }

    public function destroy(PermissionGroup $permissionGroup, PermissionGroupService $service)
    {
        return $service->destroy($permissionGroup);
    }
}
