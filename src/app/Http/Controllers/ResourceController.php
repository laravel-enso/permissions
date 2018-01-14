<?php

namespace LaravelEnso\PermissionManager\app\Http\Controllers;

use App\Http\Controllers\Controller;
use LaravelEnso\PermissionManager\app\Http\Services\ResourceService;
use LaravelEnso\PermissionManager\app\Http\Requests\ValidateResourceRequest;

class ResourceController extends Controller
{
    public function create(ResourceService $service)
    {
        return $service->create();
    }

    public function store(ValidateResourceRequest $request, ResourceService $service)
    {
        return $service->store($request);
    }
}
