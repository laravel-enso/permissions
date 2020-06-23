<?php

namespace LaravelEnso\Permissions\Forms\Builders;

use LaravelEnso\Forms\Services\Form;
use LaravelEnso\Permissions\Models\Permission;
use LaravelEnso\Roles\Models\Role;

class PermissionForm
{
    protected const FormPath = __DIR__.'/../Templates/permission.json';

    protected Form $form;

    public function __construct()
    {
        $this->form = (new Form(static::FormPath))
            ->options('roles', Role::get(['name', 'id']));
    }

    public function create()
    {
        return $this->form->create();
    }

    public function edit(Permission $permission)
    {
        return $this->form->edit($permission);
    }
}
