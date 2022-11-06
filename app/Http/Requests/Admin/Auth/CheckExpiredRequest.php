<?php

namespace App\Http\Requests\Admin\Auth;

use App\Http\Requests\BaseRequest;
use App\Rules\RegexEmail;

class CheckExpiredRequest extends BaseRequest
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
            'email' => [
                'required',
                'string',
                new RegexEmail,
            ],
            'token' => [
                'string',
                'required',
            ],
            'cachekey' => [
                'required',
                'string'
            ]
        ];
    }
}
