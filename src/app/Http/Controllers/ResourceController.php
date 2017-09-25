<?php

namespace LaravelEnso\PermissionManager\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LaravelEnso\PermissionManager\app\Http\Requests\ValidateResourceRequest;
use LaravelEnso\PermissionManager\app\Http\Services\ResourceService;

class ResourceController extends Controller
{
	private $service;

    public function __construct(ResourceService $service)
    {
        $this->service = $service;
    }

    public function create()
    {
        return $this->service->create();
    }

    public function store(ValidateResourceRequest $request)
    {
        return $this->service->store($request);
    }
}
