<?php

namespace LaravelEnso\PermissionManager\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LaravelEnso\PermissionManager\app\Http\Requests\ValidatePermissionGroupRequest;
use LaravelEnso\PermissionManager\app\Http\Services\PermissionGroupService;
use LaravelEnso\PermissionManager\app\Models\PermissionGroup;

class PermissionGroupController extends Controller
{
    private $groups;

    public function __construct(Request $request)
    {
        $this->groups = new PermissionGroupService($request);
    }

    public function index()
    {
        return view('laravel-enso/permissionmanager::permissionGroups.index');
    }

    public function create()
    {
        return $this->groups->create();
    }

    public function store(ValidatePermissionGroupRequest $request, PermissionGroup $permissionGroup)
    {
        return $this->groups->store($permissionGroup);
    }

    public function edit(PermissionGroup $permissionGroup)
    {
        return $this->groups->edit($permissionGroup);
    }

    public function update(ValidatePermissionGroupRequest $request, PermissionGroup $permissionGroup)
    {
        return $this->groups->update($permissionGroup);
    }

    public function destroy(PermissionGroup $permissionGroup)
    {
        return $this->groups->destroy($permissionGroup);
    }
}
