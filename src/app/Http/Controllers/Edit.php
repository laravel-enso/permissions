<?php

namespace LaravelEnso\Permissions\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Permissions\app\Models\Permission;
use LaravelEnso\Permissions\app\Forms\Builders\PermissionForm;

class Edit extends Controller
{
    public function __invoke(Permission $permission, PermissionForm $form)
    {
        return ['form' => $form->edit($permission)];
    }
}
