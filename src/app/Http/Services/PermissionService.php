<?php

namespace LaravelEnso\PermissionManager\app\Http\Services;

use Illuminate\Http\Request;
use LaravelEnso\RoleManager\app\Models\Role;
use LaravelEnso\FormBuilder\app\Classes\Form;
use LaravelEnso\PermissionManager\app\Models\Permission;
use LaravelEnso\PermissionManager\app\Enums\PermissionTypes;
use LaravelEnso\PermissionManager\app\Models\PermissionGroup;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class PermissionService
{
    const FormPath = __DIR__.'/../../Forms/permission.json';

    public function create()
    {
        $form = (new Form(self::FormPath))
            ->create()
            ->options('type', PermissionTypes::object())
            ->options('permission_group_id', PermissionGroup::pluck('name', 'id'))
            ->options('roleList', Role::pluck('name', 'id'))
            ->get();

        return compact('form');
    }

    public function store(Request $request, Permission $permission)
    {
        \DB::transaction(function () use ($request, &$permission) {
            $permission = $permission->create($request->all());
            $this->attachRoles($request, $permission);
        });

        return [
            'message' => __('The permission was created!'),
            'redirect' => 'system.permissions.edit',
            'id' => $permission->id,
        ];
    }

    public function edit(Permission $permission)
    {
        $permission->append(['roleList']);

        $form = (new Form(self::FormPath))
            ->edit($permission)
            ->options('type', PermissionTypes::object())
            ->options('permission_group_id', PermissionGroup::pluck('name', 'id'))
            ->options('roleList', Role::pluck('name', 'id'))
            ->get();

        return compact('form');
    }

    public function update(Request $request, Permission $permission)
    {
        \DB::transaction(function () use ($request, $permission) {
            $permission->update($request->all());
            $permission->roles()->sync($request->get('roleList'));
        });

        return [
            'message' => __(config('enso.labels.savedChanges')),
        ];
    }

    public function destroy(Permission $permission)
    {
        if ($permission->roles->count()) {
            throw new ConflictHttpException(__('Operation failed because the permission is allocated to existing role(s)'));
        }

        $permission->delete();

        return [
            'message' => __(config('enso.labels.successfulOperation')),
            'redirect' => 'system.permissions.index',
        ];
    }

    private function attachRoles(Request $request, Permission $permission)
    {
        $permission->default
        ? $permission->roles()->attach(Role::pluck('id'))
        : $permission->roles()->attach($request->get('roleList'));
    }
}
