<?php

namespace LaravelEnso\Permissions\App\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Permissions\App\Forms\Builders\PermissionForm;
use LaravelEnso\Permissions\App\Models\Permission;

class Edit extends Controller
{
    public function __invoke(Permission $permission, PermissionForm $form)
    {
        return ['form' => $form->edit($permission)];
    }
}
