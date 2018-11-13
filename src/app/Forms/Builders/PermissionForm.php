<?php

namespace LaravelEnso\PermissionManager\app\Forms\Builders;

use LaravelEnso\RoleManager\app\Models\Role;
use LaravelEnso\FormBuilder\app\Classes\Form;
use LaravelEnso\PermissionManager\app\Models\Permission;

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
