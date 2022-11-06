<?php

namespace App\Services\Auth\Admin;

use App\Repositories\AdminRepository;
use App\Services\Auth\Traits\SendMailResetPassword;
use Mi\L5Core\Services\BaseService;

class SendMailResetPasswordService extends BaseService
{
    use SendMailResetPassword;

    protected $guard                   = 'admins';
    protected $collectsData            = true;

    public function __construct(AdminRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $user   = $this->getUser($this->data->only(['email']));

        if (!$user || $user->is_first_admin || !$user->permission) {
            return ;
        }
        return $this->sendEmailResetPassword($user);
    }
}
