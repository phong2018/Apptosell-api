<?php

namespace App\Services\Auth\Traits;

use App\Enums\CacheTime;
use Illuminate\Support\Facades\Password;
use App\Models\PasswordReset;
use App\Repositories\PasswordResetRepository;
use Carbon\Carbon;
use Illuminate\Support\Str;

trait HasPasswordBroker
{
    protected function broker()
    {
        return Password::broker($this->guard);
    }

    /**
     * Create the token for database reset password
     */
    public function createToken($user)
    {
        $record = PasswordReset::where('guard', $this->guard);

        $record->where('email', $user->email)->delete();

        $token = hash_hmac('sha256', Str::random(40), config('app.key'));

        resolve(PasswordResetRepository::class)->create([
            'guard' => $this->guard,
            'email' => $user->email,
            'token' => $token
        ]);

        return $token;
    }

    /**
     * check the $token exist for user
     */
    public function tokenExists($user, $token)
    {
        $record = PasswordReset::where('guard', $this->guard);
        $record = $record->where('email', $user->email)->first();
        return $record &&
            ! $this->tokenExpired($record['created_at']) &&
            ($token == $record['token']);
    }

    /**
     * delete the $token reset password for user
     */
    public function deleteToken($user)
    {
        $record = PasswordReset::where('guard', $this->guard);
        $record->where('email', $user->email)->delete();
    }

    /**
     * check $token reset password for user expired
     */
    protected function tokenExpired($createdAt)
    {
        return Carbon::parse($createdAt)->addSeconds(CacheTime::CACHE_VERIFY_EMAIL * 24 * 60 * 60)->isPast();
    }


    /**
     * get cache key name for reset password
     */
    public function getCacheKeyNameResetPassword($user)
    {
        $cacheKey = config('custom.cache.reset_email_code') . $user->email;
        return $cacheKey;
    }

    /**
     * get cache key name for verify email
     */
    public function getCacheKeyNameVerifyEmail($user)
    {
        $cacheKey = config('custom.cache.verify_email_code') . $user->email;
        return $cacheKey;
    }

     /**
     * get cache key name from parameter in request to reset password for user
     */
    public function getCacheNameResetPasswordFromRequest($data)
    {
        $cacheKey = $data->get('cachekey') . $data->get('email');
        return $cacheKey;
    }
}
