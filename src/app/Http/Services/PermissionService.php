<?php

namespace LaravelEnso\PermissionManager\app\Http\Services;

use Illuminate\Http\Request;
use LaravelEnso\Core\app\Models\Role;
use LaravelEnso\PermissionManager\app\Enums\PermissionTypes;
use LaravelEnso\PermissionManager\app\Models\Permission;
use LaravelEnso\PermissionManager\app\Models\PermissionGroup;

class PermissionService
{
    private const AdminRoleId = 1;

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getTableQuery()
    {
        $query = Permission::select(\DB::raw('permissions.id as DT_RowId, permissions.name,
            permissions.description, permissions.type, permission_groups.name as grup,
            permissions.default, permissions.created_at, permissions.updated_at')
        )->join('permission_groups', 'permissions.permission_group_id', '=', 'permission_groups.id');

        return $query;
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
            $permission->roles()->attach(self::AdminRoleId);
            flash()->success(__('Permission created'));
        });

        return redirect('system/permissions/'.$permission->id.'/edit');
    }

    public function edit(Permission $permission)
    {
        $permission->load('permissions_group');
        $permissionTypes = (new PermissionTypes())->getData();
        $permissionGroups = PermissionGroup::pluck('name', 'id');
        $roles = Role::pluck('name', 'id');
        $permission->roles_list;

        return view(
            'laravel-enso/permissionmanager::permissions.edit',
            compact('permission', 'permissionTypes', 'permissionGroups', 'roles')
        );
    }

    public function update(Permission $permission)
    {
        \DB::transaction(function () use ($permission) {
            $permission->update($this->request->all());
            $roles = $this->request->roles_list ? $this->request->roles_list : [];
            $permission->roles()->sync($roles);
            flash()->success(__('The Changes have been saved!'));
        });

        return back();
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return ['message' => __('Operation was successfull')];
    }
}
