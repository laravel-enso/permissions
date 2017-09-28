<?php

namespace LaravelEnso\PermissionManager\app\Http\Services;

use Illuminate\Http\Request;
use LaravelEnso\FormBuilder\app\Classes\FormBuilder;
use LaravelEnso\PermissionManager\app\Models\PermissionGroup;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class PermissionGroupService
{
    private const FormPath = __DIR__.'/../../Forms/group.json';

    public function create()
    {
        $form = (new FormBuilder(self::FormPath))
            ->setMethod('POST')
            ->setTitle('Create Permission Group')
            ->getData();

        return compact('form');
    }

    public function store(Request $request, PermissionGroup $permissionGroup)
    {
        $group = $permissionGroup->create($request->all());

        return [
            'message'  => __('The permission group was created!'),
            'redirect' => route('system.permissionGroups.edit', $group->id, false),
        ];
    }

    public function edit(PermissionGroup $permissionGroup)
    {
        $form = (new FormBuilder(self::FormPath, $permissionGroup))
            ->setMethod('PATCH')
            ->setTitle('Edit Permission Group')
            ->getData();

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
            'message'  => __(config('enso.labels.successfulOperation')),
            'redirect' => route('system.permissionGroups.index', [], false),
        ];
    }
}
