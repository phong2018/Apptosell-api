<?php

namespace App\Http\Requests\Admin\Account;

use Illuminate\Validation\Rule;
use App\Http\Requests\BaseRequest;
use App\Rules\RegexEmail;

class UpdateAdminRequest extends BaseRequest
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
        // phpcs:ignore
        $accoutId = request()->route('account');
        $rules = [
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
                ->ignore($accoutId ? $accoutId : 0, 'id')
            ],
            'permission' => [
                'bail',
                'required',
                'boolean'
            ],
            'role_id' => [
                'bail',
                'required',
                Rule::exists('roles', 'id')->whereNull('deleted_at')
            ]
        ];

        return $rules;
    }
}
