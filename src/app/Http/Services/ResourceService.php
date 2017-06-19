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

        return view('laravel-enso/permissionmanager::permissions.createResource', compact('permissionGroups'));
    }

    public function store()
    {
        \DB::transaction(function () {
            $this->getPermissionCollection()->each(function ($permission) {
                $permission = Permission::create($permission);
                $permission->roles()->attach(self::AdminRoleId);
            });
        });

        flash()->success(__('The Operation was successfull'));

        return redirect()->route('system.permissions.index');
    }

    private function getPermissionCollection()
    {
        $permissions = $this->buildPermissionsList();

        foreach ($permissions as &$permission) {
            $permission['name'] = $this->request->prefix.'.'.$permission['name'];
            $permission['permission_group_id'] = $this->request->permission_group_id;
        }

        return collect($permissions);
    }

    private function buildPermissionsList()
    {
        $resource = (new ResourcePermissions());
        $permissions = $resource->getValueByKey('resource');

    	if ($this->request->hasDataTables) {
            $permissions = array_merge($permissions, $resource->getValueByKey('dataTables'));
        }

        if ($this->request->hasVueSelect) {
            $permissions = array_merge($permissions, $resource->getValueByKey('vueSelect'));
        }

        return $permissions;
    }
}