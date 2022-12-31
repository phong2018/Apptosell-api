<?php

namespace App\Http\Requests\Admin\Test;

use App\Http\Requests\BaseRequest;
use Carbon\Carbon;

class CreateTestRequest extends BaseRequest
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
        $nowTz = Carbon::now();
        return [
            'name' => [
                'required',
                'string'
            ],
            'content' => [
                'nullable',
                'string'
            ],
            'result' => [
                'nullable',
                'string'
            ],
            'image' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png',
                'max:'. self::MAX_SIZE_IMAGE,
            ],
            'sort_order' => [
                'nullable',
                'integer'
            ],
            'time_test' => [
                'required',
                'integer'
            ],
            'status' => [
                'nullable',
                'boolean'
            ]
        ];
    }
}
