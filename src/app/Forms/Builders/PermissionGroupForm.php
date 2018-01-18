<?php

namespace LaravelEnso\PermissionManager\app\Forms\Builders;

use LaravelEnso\FormBuilder\app\Classes\Form;
use LaravelEnso\PermissionManager\app\Models\PermissionGroup;

class PermissionGroupForm
{
    private const FormPath = __DIR__.'/../Templates/group.json';

    private $form;

    public function __construct()
    {
        $this->form = new Form(self::FormPath);
    }

    public function create()
    {
        return $this->form->create();
    }

    public function edit(PermissionGroup $permissionGroup)
    {
        return $this->form->edit($permissionGroup);
    }
}
