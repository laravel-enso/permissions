<?php

namespace LaravelEnso\PermissionManager\app\Http\Services;

use Illuminate\Http\Request;
use LaravelEnso\PermissionManager\app\Enums\ResourcePermissions;
use LaravelEnso\PermissionManager\app\Models\Permission;
use LaravelEnso\PermissionManager\app\Models\PermissionGroup;

class ResourceService
{
    private const AdminRoleId = 1;

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function create()
    {
        $permissionGroups = PermissionGroup::pluck('name', 'id');
        $resources = (new ResourcePermissions())->getData();

        return view('laravel-enso/permissionmanager::permissions.createResource', compact('permissionGroups', 'resources'));
    }

    public function store()
    {
        \DB::transaction(function () {
            $this->getPermissionCollection()->each(function ($permission) {
                $permission = Permission::create($permission);
                $permission->roles()->attach(self::AdminRoleId);
            });
        });

        flash()->success(__(config('labels.successfulOperation')));

        return redirect()->route('system.permissions.index');
    }

    private function getPermissionCollection()
    {
        $permissions = collect();

        foreach ($this->getPermissionList() as $permission) {
            if (!$this->request->filled($permission['name'])) {
                continue;
            }

            $permission['name'] = $this->request->get('prefix').'.'.$permission['name'];
            $permission['description'] = $permission['description'].ucfirst($this->request->get('prefix'));
            $permission['permission_group_id'] = $this->request->get('permission_group_id');
            $permissions->push($permission);
        }

        return $permissions;
    }

    private function getPermissionList()
    {
        $resource = (new ResourcePermissions());
        $permissions = $resource->getValueByKey('resource');
        $permissions = array_merge($permissions, $resource->getValueByKey('dataTables'));
        $permissions = array_merge($permissions, $resource->getValueByKey('vueSelect'));

        return $permissions;
    }
}
