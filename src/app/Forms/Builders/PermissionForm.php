<?php

namespace LaravelEnso\Permissions\app\Forms\Builders;

use LaravelEnso\Roles\app\Models\Role;
use LaravelEnso\Forms\app\Services\Form;
use LaravelEnso\Permissions\app\Models\Permission;

class PermissionForm
{
    private const FormPath = __DIR__.'/../Templates/permission.json';

    private $form;

    public function __construct()
    {
        $this->form = (new Form(self::FormPath))
            ->options('roles', Role::get(['name', 'id']));
    }

    public function create()
    {
        return $this->form->create();
    }

    public function edit(Permission $permission)
    {
        return $this->form
            ->edit($permission);
    }
}
