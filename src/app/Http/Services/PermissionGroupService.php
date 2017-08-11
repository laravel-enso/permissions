<?php

namespace LaravelEnso\PermissionManager\app\Http\Services;

use Illuminate\Http\Request;
use LaravelEnso\FormBuilder\app\Classes\FormBuilder;
use LaravelEnso\PermissionManager\app\Models\PermissionGroup;

class PermissionGroupService
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function create()
    {
        $form = (new FormBuilder(__DIR__ . '/../../Forms/group.json'))
            ->setAction('POST')
            ->setTitle('Create Permission Group')
            ->setUrl('/system/permissionGroups')
            ->getData();

        return view('laravel-enso/permissionmanager::permissionGroups.create', compact('form'));
    }

    public function store(PermissionGroup $permissionGroup)
    {
        $group = $permissionGroup->create($this->request->all());

        return [
            'message'  => __('The permission group was created!'),
            'redirect' => '/system/permissionGroups/' . $group->id . '/edit',
        ];
    }

    public function edit(PermissionGroup $permissionGroup)
    {
        $form = (new FormBuilder(__DIR__ . '/../../Forms/group.json', $permissionGroup))
            ->setAction('PATCH')
            ->setTitle('Edit Permission Group')
            ->setUrl('/system/permissionGroups/' . $permissionGroup->id)
            ->getData();

        return view('laravel-enso/permissionmanager::permissionGroups.edit', compact('form'));
    }

    public function update(PermissionGroup $permissionGroup)
    {
        $permissionGroup->update($this->request->all());

        return [
            'message' => __(config('labels.savedChanges')),
        ];
    }

    public function destroy(PermissionGroup $permissionGroup)
    {
        if ($permissionGroup->permissions->count()) {
            throw new \EnsoException(__('The permission group cannot be deleted because it has child permissions'), 'warning');
        }

        $permissionGroup->delete();

        return [
            'message' => __(config('labels.successfulOperation')),
        ];
    }
}
