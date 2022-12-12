<?php

namespace App\Http\Requests\Admin\Post;

use App\Http\Requests\BaseRequest;
use Carbon\Carbon;

class UpdatePostRequest extends BaseRequest
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
            'description' => [
                'nullable',
                'string'
            ],
            'content' => [
                'nullable',
                'string'
            ],
            'sort_order' => [
                'nullable',
                'integer'
            ],
            'status' => [
                'nullable',
                'boolean'
            ],
            'image' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png',
                'max:'. self::MAX_SIZE_IMAGE,
            ],
            'publish_date' => [
                'nullable',
                'date',
                'date_format:Y/m/d',
                'after:'.$nowTz->format('Y/m/d')
            ]
        ];
    }
}
