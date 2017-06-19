<?php

namespace LaravelEnso\PermissionManager\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LaravelEnso\PermissionManager\app\Http\Requests\ValidateResourceRequest;
use LaravelEnso\PermissionManager\app\Http\Services\ResourceService;

class ResourceController extends Controller
{
    private $resources;

    public function __construct(Request $request)
    {
        $this->resources = new ResourceService($request);
    }

    public function create()
    {
        return $this->resources->create();
    }

    public function store(ValidateResourceRequest $request)
    {
        return $this->resources->store();
    }
}
