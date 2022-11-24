<?php

namespace App\Http\Requests\Admin\Image;

use App\Http\Requests\BaseRequest;

class PreSignedImageRequest extends BaseRequest
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
            'file_name' => [
                'bail',
                'required',
                'string',
                'regex:'.self::PATH_IMAGE
            ],
            'path' => [
                'bail',
                'required',
                'string'
            ],
        ];
    }
}
