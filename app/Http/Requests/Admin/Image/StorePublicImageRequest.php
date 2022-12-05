<?php

namespace App\Http\Requests\Admin\Image;

use App\Http\Requests\BaseRequest;

class StorePublicImageRequest extends BaseRequest
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
            'upload' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png',
                'max:'. self::MAX_SIZE_IMAGE,
            ],
            'uploads' => [
                'nullable',
                'array'
            ],
            'uploads.*' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png',
                'max:'. self::MAX_SIZE_IMAGE,
            ],
            'file_pạth' => [
                'nullable'
            ],
        ];
    }
}
