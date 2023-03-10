<?php

namespace App\Services\Auth\Admin;

use App\Enums\ExceptionTypes;
use App\Repositories\AdminRepository;
use App\Services\Auth\Traits\HasPasswordBroker;
use App\Services\Auth\Traits\ResetPassword;
use Illuminate\Support\Facades\Cache;
use Mi\L5Core\Exceptions\BaseException;
use Mi\L5Core\Services\BaseService;

class ResetPasswordService extends BaseService
{
    use ResetPassword, HasPasswordBroker;

    protected $guard        = 'admins';
    protected $collectsData = true;

    public function __construct(AdminRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $cacheKey = $this->getCacheNameResetPasswordFromRequest($this->data);

        throw_if(
            !Cache::has($cacheKey),
            BaseException::code(ExceptionTypes::TOKEN_EXPIRED)
        );
        $msg = $this->reset(['password', 'password_confirmation', 'token', 'email']);
        Cache::forget($cacheKey);

        return $msg;
    }
}
