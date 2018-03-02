<?php

namespace LaravelEnso\PermissionManager\app\Forms\Builders;

use LaravelEnso\RoleManager\app\Models\Role;
use LaravelEnso\FormBuilder\app\Classes\Form;
use LaravelEnso\PermissionManager\app\Models\Permission;
use LaravelEnso\PermissionManager\app\Enums\PermissionTypes;
use LaravelEnso\PermissionManager\app\Models\PermissionGroup;

class PermissionForm
{
    private const FormPath = __DIR__.'/../Templates/permission.json';

    private $form;

    public function __construct()
    {
        $this->form = new Form(self::FormPath);
    }

    public function create()
    {
        return $this->form
            ->options('type', PermissionTypes::select())
            ->options('permission_group_id', PermissionGroup::get(['name', 'id']))
            ->options('roleList', Role::get(['name', 'id']))
            ->create();
    }

    public function edit(Permission $permission)
    {
        $permission->append(['roleList']);

        return $this->form
            ->options('type', PermissionTypes::select())
            ->options('permission_group_id', PermissionGroup::get(['name', 'id']))
            ->options('roleList', Role::get(['name', 'id']))
            ->edit($permission);
    }
}
