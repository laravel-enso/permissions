<?php

namespace LaravelEnso\Permissions\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Permission extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'isDefault' => $this->is_default,
            'type' => $this->type(),
        ];
    }
}
