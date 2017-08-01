<?php

namespace LaravelEnso\PermissionManager\app\Http\Services;

use Illuminate\Http\Request;
use LaravelEnso\PermissionManager\app\Enums\PermissionTypes;
use LaravelEnso\PermissionManager\app\Models\Permission;
use LaravelEnso\PermissionManager\app\Models\PermissionGroup;
use LaravelEnso\RoleManager\app\Models\Role;

class PermissionService
{
    private const AdminRoleId = 1;

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        return view('laravel-enso/permissionmanager::permissions.index');
    }

    public function create()
    {
        $permissionTypes = (new PermissionTypes())->getData();
        $permissionGroups = PermissionGroup::pluck('name', 'id');

        return view('laravel-enso/permissionmanager::permissions.create', compact('permissionTypes', 'permissionGroups'));
    }

    public function store(Permission $permission)
    {
        \DB::transaction(function () use (&$permission) {
            $permission = $permission->create($this->request->all());
            $this->attachRoles($permission);
            flash()->success(__('Permission created'));
        });

        return redirect('system/permissions/'.$permission->id.'/edit');
    }

    public function edit(Permission $permission)
    {
        $permissionTypes = (new PermissionTypes())->getData();
        $permissionGroups = PermissionGroup::pluck('name', 'id');
        $roles = Role::pluck('name', 'id');
        $permission->roleList;

        return view(
            'laravel-enso/permissionmanager::permissions.edit',
            compact('permission', 'permissionTypes', 'permissionGroups', 'roles')
        );
    }

    public function update(Permission $permission)
    {
        \DB::transaction(function () use ($permission) {
            $permission->update($this->request->all());
            $roles = $this->request->has('roleList') ? $this->request->get('roleList') : [];
            $permission->roles()->sync($roles);
            flash()->success(__(config('labels.savedChanges')));
        });

        return back();
    }

    public function destroy(Permission $permission)
    {
        if ($permission->roles->count()) {
            throw new \EnsoException(__('Operation failed because the permission is allocated to existing role(s)'));
        }

        $permission->delete();

        return ['message' => __(config('labels.successfulOperation'))];
    }

    private function attachRoles(Permission $permission)
    {
        return $permission->default
            ? $permission->roles()->attach(Role::pluck('id'))
            : $permission->roles()->attach(self::AdminRoleId);
    }
}
