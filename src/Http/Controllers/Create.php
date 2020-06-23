<?php

namespace LaravelEnso\Permissions\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Permissions\Forms\Builders\PermissionForm;

class Create extends Controller
{
    public function __invoke(PermissionForm $form)
    {
        return ['form' => $form->create()];
    }
}
