<?php

namespace LaravelEnso\PermissionManager\app\Classes;

use LaravelEnso\PermissionManager\app\Models\Permission;
use LaravelEnso\PermissionManager\app\Enums\ResourcePermissions;

class ResourceCreator
{
    private const AdminRoleId = [1];

    private $request;

    public function __construct(array $request)
    {
        $this->request = $request;
    }

    public function store()
    {
        \DB::transaction(function () {
            $this->permissionCollection($this->request)
                ->each(function ($permission) {
                    $permission['roleList'] = self::AdminRoleId;
                    (new Permission())
                        ->storeWithRoles($permission);
                });
        });
    }

    private function permissionCollection()
    {
        return collect($this->permissionList())
            ->filter(function ($permission) {
                return $this->request[$permission['name']];
            })->reduce(function ($permissions, $permission) {
                $permissions->push([
                    'name' => $this->request['prefix'].'.'.$permission['name'],
                    'description' => $permission['description'].ucfirst($this->request['prefix']),
                    'permission_group_id' => $this->request['permission_group_id'],
                    'type' => $permission['type'],
                ]);

                return $permissions;
            }, collect());
    }

    private function permissionList()
    {
        return collect(ResourcePermissions::get('resource'))
            ->merge(ResourcePermissions::get('dataTables'))
            ->merge(ResourcePermissions::get('vueSelect'));
    }
}
