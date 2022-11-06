<?php

namespace App\Services\Auth\Admin;

use App\Repositories\AdminRepository;
use App\Services\Auth\Traits\HasPasswordBroker;
use App\Services\Auth\Traits\ResetPassword;
use Illuminate\Support\Facades\Cache;
use Mi\L5Core\Services\BaseService;

class CheckExpiredService extends BaseService
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
        $cacheKey = $this->data->get('cachekey') . $this->data->get('email');
        if (!Cache::has($cacheKey)) {
            return false;
        }

        $credentials = $this->data->only(['email', 'token'])->toArray();
        $user = $this->broker()->getUser($credentials);

        if (!$this->tokenExists($user, $credentials['token'])) {
            return false;
        }

        return true;
    }
}
