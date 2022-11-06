<?php

namespace App\Services\Auth\Traits;

use App\Enums\CacheTime;
use App\Enums\ExceptionTypes;
use Illuminate\Http\Response;
use App\Services\Auth\Traits\HasPasswordBroker;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Password;
use Mi\L5Core\Exceptions\BaseException;

trait SendMailResetPassword
{
    use HasPasswordBroker;

    protected $startCount = 1;

    public function sendEmailResetPassword($user)
    {
        $prefix = '';
        $key    = $prefix . config('auth.send_mail.default.max_email_verify_code_key');
        $token  = $this->createToken($user);

        $this->checkLimited($user, $key);

        $cacheKey = $this->getCacheKeyNameResetPassword($user);
        Cache::put($cacheKey, $token, now()->addDays(CacheTime::CACHE_RESET_PASSWORD));
        $user->sendPasswordResetNotification($token);
        $this->updateLimited($user, $key);
        // forget token verify
        $cacheKey = config('custom.cache.verify_email_code') . $user->email;
        Cache::forget($cacheKey);

        // forget token verify
        $cacheKey = $this->getCacheKeyNameVerifyEmail($user);
        Cache::forget($cacheKey);

        return Password::RESET_LINK_SENT;
    }

    protected function getUser($credentials)
    {
        $user = $this->broker()->getUser($credentials->toArray());
        return $user;
    }

    protected function checkLimited($receiver, $key = null)
    {
        $key       = is_null($key) ? config('auth.send_mail.default.max_verify_code_key') : $key;
        $cacheName = "{$key}{$receiver}";

        if (!Cache::has($cacheName)) {
            return;
        }

        $result        = json_decode(Cache::get($cacheName));
        $startTime     = Carbon::parse($result->start_time);
        $count         = $result->count;
        $limitedTime   = now()->diffInMinutes($startTime);
        $liveTime      = config('auth.send_mail.default.cache_live_time') - $limitedTime;
        $maxVerifyCode = config('auth.send_mail.default.max_verify_code');

        if ($liveTime > 0 && $count >= $maxVerifyCode) {
            throw BaseException::code(ExceptionTypes::LIMITED_SEND_RESET, ['liveTime' => $liveTime], Response::HTTP_FORBIDDEN);
        }
    }

    protected function updateLimited($receiver, $key = null)
    {
        $key       = is_null($key) ? config('auth.send_mail.default.max_verify_code_key') : $key;
        $cacheName = "{$key}{$receiver}";

        if (Cache::has($cacheName)) {
            $result = json_decode(Cache::get($cacheName));

            $startTime = Carbon::parse($result->start_time);
            $count = $result->count + 1;

            $result = collect([
                'count' => $count,
                'start_time' => $startTime->timestamp
            ]);

            Cache::put($cacheName, $result, $startTime->addMinutes(config('auth.send_mail.default.cache_live_time')));

            return;
        }

        $current = now();
        $result = collect([
            'count' => $this->startCount,
            'start_time' => $current->timestamp
        ]);

        Cache::put($cacheName, $result, $current->addMinutes(config('auth.send_mail.default.cache_live_time')));
    }
}
