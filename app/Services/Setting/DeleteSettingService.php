<?php

namespace App\Services\Setting;

use App\Repositories\SettingRepository;
use Mi\L5Core\Services\BaseService;

class DeleteSettingService extends BaseService
{
    public function __construct(SettingRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        return $this->model->delete();
    }
}
