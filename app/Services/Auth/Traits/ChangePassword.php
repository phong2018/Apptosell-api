<?php

namespace App\Services\Auth\Traits;

use App\Exceptions\ResetPasswordException;
use Illuminate\Support\Facades\Hash;

trait ChangePassword
{
    public function changePassword($params, $user)
    {
        $password = $params['password'];
        $oldPassword = $params['old_password'];

        if (!Hash::check($oldPassword, $user->password)) {
            throw ResetPasswordException::incorrectOldPassword();
        }

        if (Hash::check($password, $user->password)) {
            throw ResetPasswordException::notUseSameOldPassword();
        }

        $this->updatePassword($user, $password);

        return [
            'access_token' => auth($this->guard ?? 'users')->login($user),
            'user_id' => $user->id,
        ];
    }
}
