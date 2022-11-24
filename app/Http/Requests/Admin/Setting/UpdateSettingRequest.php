<?php

namespace App\Http\Requests\Admin\Setting;

use App\Http\Requests\BaseRequest;

class UpdateSettingRequest extends BaseRequest
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
            'type' => [
                'bail',
                'required',
                'string'
            ],
            'content' => [
                'bail',
                'required',
                'string'
            ],
            'status' => [
                'nullable',
                'boolean'
            ]
        ];
    }
}
