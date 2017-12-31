<?php

namespace LaravelEnso\PermissionManager\app\Http\Services;

use Illuminate\Http\Request;
use LaravelEnso\FormBuilder\app\Classes\Form;
use LaravelEnso\PermissionManager\app\Models\PermissionGroup;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class PermissionGroupService
{
    const FormPath = __DIR__.'/../../Forms/group.json';

    public function create()
    {
        $form = (new Form(self::FormPath))
            ->create()
            ->get();

        return compact('form');
    }

    public function store(Request $request, PermissionGroup $permissionGroup)
    {
        $group = $permissionGroup->create($request->all());

        return [
            'message' => __('The permission group was created!'),
            'redirect' => 'system.permissionGroups.edit',
            'id' => $group->id,
        ];
    }

    public function edit(PermissionGroup $permissionGroup)
    {
        $form = (new Form(self::FormPath))
            ->edit($permissionGroup)
            ->get();

        return compact('form');
    }

    public function update(Request $request, PermissionGroup $permissionGroup)
    {
        $permissionGroup->update($request->all());

        return [
            'message' => __(config('enso.labels.savedChanges')),
        ];
    }

    public function destroy(PermissionGroup $permissionGroup)
    {
        if ($permissionGroup->permissions->count()) {
            throw new ConflictHttpException(__('The permission group cannot be deleted because it has child permissions'));
        }

        $permissionGroup->delete();

        return [
            'message' => __(config('enso.labels.successfulOperation')),
            'redirect' => 'system.permissionGroups.index',
        ];
    }
}
