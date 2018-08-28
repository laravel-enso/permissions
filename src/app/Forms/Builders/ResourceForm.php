<?php

namespace LaravelEnso\PermissionManager\app\Forms\Builders;

use LaravelEnso\FormBuilder\app\Classes\Form;
use LaravelEnso\PermissionManager\app\Models\PermissionGroup;

class ResourceForm
{
    private const FormPath = __DIR__.'/../Templates/resource.json';

    private $form;

    public function __construct()
    {
        $this->form = new Form(self::FormPath);
    }

    public function create()
    {
        return $this->form
            ->options('permission_group_id', PermissionGroup::get(['name', 'id']))
            ->create();
    }
}
