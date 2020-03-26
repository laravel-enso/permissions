<?php

namespace LaravelEnso\Permissions\App\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Permissions\App\Forms\Builders\PermissionForm;

class Create extends Controller
{
    public function __invoke(PermissionForm $form)
    {
        return ['form' => $form->create()];
    }
}
