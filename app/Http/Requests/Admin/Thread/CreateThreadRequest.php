<?php

namespace App\Http\Requests\Admin\Thread;

use App\Http\Requests\BaseRequest;

class CreateThreadRequest extends BaseRequest
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
                'required',
                'string'
            ],
            'content' => [
                'nullable'
            ],
            'sort_order' => [
                'nullable',
                'integer'
            ],
            'status' => [
                'nullable',
                'boolean'
            ]
        ];
    }
}
