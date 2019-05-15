<?php

namespace LaravelEnso\Permissions\app\Http\Requests;

class ValidatePermissionUpdate extends ValidatePermissionStore
{
    protected function nameUnique()
    {
        return parent::nameUnique()
            ->ignore($this->route('permission')->id);
    }
}
