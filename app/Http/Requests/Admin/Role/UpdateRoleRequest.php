<?php

namespace App\Http\Requests\Admin\Role;

use App\Http\Requests\BaseRequest;

class UpdateRoleRequest extends BaseRequest
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
        return [
            'name' => [
                'bail',
                'required',
                'string'
            ],
            'note' => [
                'bail',
                'required',
                'string'
            ],
            'route' => [
                'bail',
                'required',
                'string'
            ],
            'permissions' => [
                'nullable',
                'array'
            ],
            'permissions.*' => [
                'nullable',
                'string'
            ]
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'サービス名',
        ];
    }
}
