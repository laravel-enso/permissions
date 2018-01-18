<?php

namespace LaravelEnso\PermissionManager\app\Http\Controllers;

use App\Http\Controllers\Controller;
use LaravelEnso\PermissionManager\app\Handlers\ResourceCreator;
use LaravelEnso\PermissionManager\app\Forms\Builders\ResourceForm;
use LaravelEnso\PermissionManager\app\Http\Requests\ValidateResourceRequest;

class ResourceController extends Controller
{
    public function create(ResourceForm $form)
    {
        return ['form' => $form->create()];
    }

    public function store(ValidateResourceRequest $request)
    {
        (new ResourceCreator($request->all()))->store();

        return [
            'message' => __('The permissions were created!'),
            'redirect' => 'system.permissions.index',
        ];
    }
}
