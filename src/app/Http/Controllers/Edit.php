<?php

namespace LaravelEnso\Permissions\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Permissions\app\Forms\Builders\PermissionForm;
use LaravelEnso\Permissions\app\Models\Permission;

class Edit extends Controller
{
    public function __invoke(Permission $permission, PermissionForm $form)
    {
        return ['form' => $form->edit($permission)];
    }
}
