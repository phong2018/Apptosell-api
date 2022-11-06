<?php

namespace App\Http\Requests\Admin\Account;

use App\Http\Requests\BaseRequest;
use App\Rules\RegexEmail;
use Illuminate\Validation\Rule;

class CreateAdminRequest extends BaseRequest
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
                'string',
                'max:' . self::MAX_LENGTH_NAME_ACCOUNT,
            ],
            'email' => [
                'bail',
                'required',
                'string',
                'max:' . self::MAX_LENGTH_EMAIL,
                new RegexEmail,
                Rule::unique('admins', 'email')
            ],
            'permission' => [
                'bail',
                'required',
                'boolean'
            ]
        ];
    }
}
