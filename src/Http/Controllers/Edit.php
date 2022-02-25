<?php

namespace LaravelEnso\Permissions\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Permissions\Forms\Builders\Permission;
use LaravelEnso\Permissions\Models\Permission as Model;

class Edit extends Controller
{
    public function __invoke(Model $permission, Permission $form)
    {
        return ['form' => $form->edit($permission)];
    }
}
