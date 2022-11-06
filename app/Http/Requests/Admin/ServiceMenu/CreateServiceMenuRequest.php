<?php

namespace App\Http\Requests\Admin\ServiceMenu;

use App\Http\Requests\BaseRequest;

class CreateServiceMenuRequest extends BaseRequest
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
            'image' => [
                'bail',
                'sometimes',
                'file',
                'mimes:jpg,jpeg,png',
                'max:' . self::MAX_SIZE_IMAGE,
                'image',
            ],
            'is_use' => [
                'nullable',
                'boolean'
            ]
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans('validation.attributes.service_menu_name'), // phpcs:ignore
        ];
    }
}
