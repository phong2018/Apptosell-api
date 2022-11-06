<?php

namespace App\Services\Admin;

use App\Services\Auth\Traits\ChangePassword;
use App\Services\Auth\Traits\ResetPassword;
use Mi\L5Core\Services\BaseService;

class ChangePasswordService extends BaseService
{
    use ChangePassword, ResetPassword;
    protected $guard        = 'admins';
    protected $collectsData = true;
    public function __construct()
    {
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $params = [
            'password' => $this->data->get('password'),
            'old_password' => $this->data->get('old_password')
        ];

        return $this->changePassword($params, $this->handler);
    }
}
