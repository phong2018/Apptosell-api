<?php

namespace App\Services\Auth\Admin;

use App\Enums\ExceptionTypes;
use App\Enums\Permission;
use Mi\L5Core\Services\BaseService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;

class LoginService extends BaseService
{
    /**
     * Logic to handle the data
     */
    public function handle()
    {

        $token = Auth::guard('admins')->attempt($this->data);

        throw_if(empty($token), new AuthenticationException(ExceptionTypes::INVALID_LOGIN_CREDENTIALS));

        $user = Auth::guard('admins')->user();

        throw_if($user->permission === Permission::NO, new AuthenticationException(ExceptionTypes::INVALID_LOGIN_CREDENTIALS));

        return [
            'access_token' => $token,
            'currentUser' => $user
        ];
    }
}
