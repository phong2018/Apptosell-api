<?php

namespace App\Services\Admin;

use App\Common\StrHelper;
use App\Enums\CacheTime;
use App\Notifications\EmailAfterCreateAdminNotification;
use App\Repositories\AdminRepository;
use App\Services\Auth\Traits\HasPasswordBroker;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Mi\L5Core\Services\BaseService;

class CreateAdminService extends BaseService
{
    use HasPasswordBroker;

    protected $collectsData = true;
    protected $guard        = 'admins';

    public function __construct(
        AdminRepository $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        return DB::transaction(function () {
            $dataAdmin = $this->data->only([
                'name',
                'email',
                'permission'
            ])->toArray();

            $dataAdmin['password'] = rand(10000000,99999999);

            $admin = $this->repository->create($dataAdmin);

            $token  = $this->createToken($admin);
            $cacheKey = $this->getCacheKeyNameVerifyEmail($admin);
            Cache::put($cacheKey, $token, now()->addDays(CacheTime::CACHE_VERIFY_EMAIL));

            Notification::send($admin, new EmailAfterCreateAdminNotification($token));

            return $admin;
        });
    }
}
