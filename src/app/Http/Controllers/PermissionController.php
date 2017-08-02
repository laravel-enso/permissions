<?php

namespace LaravelEnso\PermissionManager\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LaravelEnso\PermissionManager\app\Http\Requests\ValidatePermissionRequest;
use LaravelEnso\PermissionManager\app\Http\Services\PermissionService;
use LaravelEnso\PermissionManager\app\Models\Permission;

class PermissionController extends Controller
{
    private $permissions;

    public function __construct(Request $request)
    {
        $this->permissions = new PermissionService($request);
    }

    public function getTableQuery()
    {
        return $this->permissions->getTableQuery();
    }

    public function index()
    {
        return view('laravel-enso/permissionmanager::permissions.index');
    }

    public function create()
    {
        return $this->permissions->create();
    }

    public function store(ValidatePermissionRequest $request, Permission $permission)
    {
        return $this->permissions->store($permission);
    }

    public function edit(Permission $permission)
    {
        return $this->permissions->edit($permission);
    }

    public function update(ValidatePermissionRequest $request, Permission $permission)
    {
        return $this->permissions->update($permission);
    }

    public function destroy(Permission $permission)
    {
        return $this->permissions->destroy($permission);
    }
}
