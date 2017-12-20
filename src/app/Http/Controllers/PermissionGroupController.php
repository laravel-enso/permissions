<?php

namespace LaravelEnso\PermissionManager\app\Http\Controllers;

use App\Http\Controllers\Controller;
use LaravelEnso\PermissionManager\app\Models\PermissionGroup;
use LaravelEnso\PermissionManager\app\Http\Services\PermissionGroupService;
use LaravelEnso\PermissionManager\app\Http\Requests\ValidatePermissionGroupRequest;

class PermissionGroupController extends Controller
{
    private $service;

    public function __construct(PermissionGroupService $service)
    {
        $this->service = $service;
    }

    public function create()
    {
        return $this->service->create();
    }

    public function store(ValidatePermissionGroupRequest $request, PermissionGroup $permissionGroup)
    {
        return $this->service->store($request, $permissionGroup);
    }

    public function edit(PermissionGroup $permissionGroup)
    {
        return $this->service->edit($permissionGroup);
    }

    public function update(ValidatePermissionGroupRequest $request, PermissionGroup $permissionGroup)
    {
        return $this->service->update($request, $permissionGroup);
    }

    public function destroy(PermissionGroup $permissionGroup)
    {
        return $this->service->destroy($permissionGroup);
    }
}
