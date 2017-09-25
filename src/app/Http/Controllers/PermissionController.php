<?php

namespace LaravelEnso\PermissionManager\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LaravelEnso\PermissionManager\app\Http\Requests\ValidatePermissionRequest;
use LaravelEnso\PermissionManager\app\Http\Services\PermissionService;
use LaravelEnso\PermissionManager\app\Models\Permission;

class PermissionController extends Controller
{
    private $service;

    public function __construct(PermissionService $service)
    {
        $this->service = $service;
    }

    public function create()
    {
        return $this->service->create();
    }

    public function store(ValidatePermissionRequest $request, Permission $permission)
    {
        return $this->service->store($request, $permission);
    }

    public function edit(Permission $permission)
    {
        return $this->service->edit($permission);
    }

    public function update(ValidatePermissionRequest $request, Permission $permission)
    {
        return $this->service->update($request, $permission);
    }

    public function destroy(Permission $permission)
    {
        return $this->service->destroy($permission);
    }
}
