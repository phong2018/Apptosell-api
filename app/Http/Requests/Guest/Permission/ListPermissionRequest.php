<?php

namespace App\Http\Requests\Guest\Permission;

use App\Http\Requests\BaseRequest;

class ListPermissionRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge($this->commonListRules(), [
            'role' => [
                'nullable',
                'string'
            ]
        ]);
    }
}
