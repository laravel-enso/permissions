<?php

namespace LaravelEnso\PermissionManager\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ValidatePermissionGroupRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $permissionGroup = $this->route('permissionGroup');
        $nameUnique = Rule::unique('permission_groups', 'name');
        $nameUnique = $this->_method == 'PATCH' ? $nameUnique->ignore($permissionGroup->id) : $nameUnique;

        return [
            'name'        => [ 'required', $nameUnique ],
            'description' => 'required',
        ];
    }
}
