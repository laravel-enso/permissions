<?php

namespace LaravelEnso\PermissionManager\app\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use LaravelEnso\PermissionManager\app\Classes\ResourceCreator;
use LaravelEnso\PermissionManager\app\Forms\Builders\ResourceForm;
use LaravelEnso\PermissionManager\app\Http\Requests\ValidateResourceRequest;

class ResourceController extends Controller
{
    use ValidatesRequests;

    public function create(ResourceForm $form)
    {
        return ['form' => $form->create()];
    }

    public function store(ValidateResourceRequest $request)
    {
        (new ResourceCreator($request->validated()))->store();

        return [
            'message' => __('The permissions were created!'),
            'redirect' => 'system.permissions.index',
        ];
    }
}
