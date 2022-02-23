<?php

namespace LaravelEnso\Permissions\Forms\Builders;

use LaravelEnso\Forms\Services\Form;
use LaravelEnso\Permissions\Models\Permission as Model;
use LaravelEnso\Roles\Models\Role;

class Permission
{
    private const TemplatePath = __DIR__.'/../Templates/permission.json';

    protected Form $form;

    public function __construct()
    {
        $this->form = (new Form($this->templatePath()))
            ->options('roles', Role::get(['name', 'id']));
    }

    public function create()
    {
        return $this->form->create();
    }

    public function edit(Model $permission)
    {
        return $this->form->edit($permission);
    }

    protected function templatePath(): string
    {
        return self::TemplatePath;
    }
}
