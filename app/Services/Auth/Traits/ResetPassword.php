<?php

namespace App\Services\Auth\Traits;

use App\Exceptions\ResetPasswordException;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

trait ResetPassword
{
    public function setGuard($guard)
    {
        $this->guard = $guard;

        return $this;
    }

    protected function reset($params)
    {
        $credentials = $this->data->only($params)->toArray();
        $user        = $this->validateReset($credentials);

        if (!$user instanceof CanResetPasswordContract) {
            throw ResetPasswordException::errorReset($user);
        }

        $password = $this->data->get('password');

        if (Hash::check($password, $user->password)) {
            throw ResetPasswordException::notUseSameOldPassword();
        }

        $this->resetPassword($user, $password);
        $this->deleteToken($user);

        return [
            'message' => __('messages.' . Password::PASSWORD_RESET)
        ];
    }

    protected function resetPassword($user, $password)
    {
        $this->updatePassword($user, $password);

        event(new PasswordReset($user));
    }

    protected function updatePassword($user, $password)
    {
        $user->password = $password;
        $user->save();
    }

    protected function validateReset($credentials)
    {
        if (is_null($user = $this->broker()->getUser($credentials))) {
            return Password::INVALID_USER;
        }

        if (!$this->tokenExists($user, $credentials['token'])) {
            return Password::INVALID_TOKEN;
        }

        return $user;
    }
}
