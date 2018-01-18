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
            ->options('type', PermissionTypes::object())
            ->options('permission_group_id', PermissionGroup::pluck('name', 'id'))
            ->options('roleList', Role::pluck('name', 'id'))
            ->create();
    }

    public function edit(Permission $permission)
    {
        $permission->append(['roleList']);

        return $this->form
            ->options('type', PermissionTypes::object())
            ->options('permission_group_id', PermissionGroup::pluck('name', 'id'))
            ->options('roleList', Role::pluck('name', 'id'))
            ->edit($permission);
    }
}
