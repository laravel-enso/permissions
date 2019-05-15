<?php

namespace LaravelEnso\Permissions\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Permissions\app\Forms\Builders\PermissionForm;

class Create extends Controller
{
    public function __invoke(PermissionForm $form)
    {
        return ['form' => $form->create()];
    }
}
