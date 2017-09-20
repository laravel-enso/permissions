<?php

namespace LaravelEnso\PermissionManager\app\Http\Services;

use Illuminate\Http\Request;
use LaravelEnso\FormBuilder\app\Classes\FormBuilder;
use LaravelEnso\PermissionManager\app\Enums\PermissionTypes;
use LaravelEnso\PermissionManager\app\Models\Permission;
use LaravelEnso\PermissionManager\app\Models\PermissionGroup;
use LaravelEnso\RoleManager\app\Models\Role;

class PermissionService
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function create()
    {
        $form = (new FormBuilder(__DIR__.'/../../Forms/permission.json'))
            ->setAction('POST')
            ->setTitle('Create Permission')
            ->setUrl('/system/permissions')
            ->setSelectOptions('type', (object) (new PermissionTypes())->getData())
            ->setSelectOptions('permission_group_id', PermissionGroup::pluck('name', 'id'))
            ->setSelectOptions('roleList', Role::pluck('name', 'id'))
            ->getData();

        return view('laravel-enso/permissionmanager::permissions.create', compact('form'));
    }

    public function store(Permission $permission)
    {
        \DB::transaction(function () use (&$permission) {
            $permission = $permission->create($this->request->all());
            $this->attachRoles($permission);
        });

        return [
            'message'  => __('The permission was created!'),
            'redirect' => '/system/permissions/'.$permission->id.'/edit',
        ];
    }

    public function edit(Permission $permission)
    {
        $permission->append(['roleList']);

        $form = (new FormBuilder(__DIR__.'/../../Forms/permission.json', $permission))
            ->setAction('PATCH')
            ->setTitle('Edit Permission')
            ->setUrl('/system/permissions/'.$permission->id)
            ->setSelectOptions('type', (object) (new PermissionTypes())->getData())
            ->setSelectOptions('permission_group_id', PermissionGroup::pluck('name', 'id'))
            ->setSelectOptions('roleList', Role::pluck('name', 'id'))
            ->getData();

        return view('laravel-enso/permissionmanager::permissions.edit', compact('form'));
    }

    public function update(Permission $permission)
    {
        \DB::transaction(function () use ($permission) {
            $permission->update($this->request->all());
            $roles = $this->request->filled('roleList') ? $this->request->get('roleList') : [];
            $permission->roles()->sync($roles);
        });

        return [
            'message' => __(config('labels.savedChanges')),
        ];
    }

    public function destroy(Permission $permission)
    {
        if ($permission->roles->count()) {
            throw new \EnsoException(__('Operation failed because the permission is allocated to existing role(s)'));
        }

        $permission->delete();

        return [
            'message'  => __(config('labels.successfulOperation')),
            'redirect' => '/system/permissions',
        ];
    }

    private function attachRoles(Permission $permission)
    {
        return $permission->default
            ? $permission->roles()->attach(Role::pluck('id'))
            : $permission->roles()->attach(
                $this->request->filled('roleList')
                    ? $this->request->get('roleList')
                    : []
            );
    }
}
