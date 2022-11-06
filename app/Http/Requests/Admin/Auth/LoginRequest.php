<?php

namespace App\Http\Requests\Admin\Auth;

use App\Http\Requests\BaseRequest;
use App\Rules\RegexEmail;
use App\Rules\RegexHalfsizeNumberCharacterSymbol;

class LoginRequest extends BaseRequest
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
                'max:' . self::MAX_LENGTH_EMAIL,
                new RegexEmail,
            ],
            'password' => [
                'required',
                'min:' . self::MIN_LENGTH_PASSWORD,
                'max:' . self::MAX_LENGTH_PASSWORD,
                new RegexHalfsizeNumberCharacterSymbol,
            ]
        ];
    }
}
