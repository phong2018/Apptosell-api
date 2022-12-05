<?php

namespace App\Services\Setting;

use App\Common\Image;
use App\Repositories\SettingRepository;
use Mi\L5Core\Services\BaseService;

class CreateSettingService extends BaseService
{
    protected $collectsData = true;

    public function __construct(
        SettingRepository $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        return $this->repository->create($this->data->only([
            'name',
            'content',
            'status'
        ])->toArray());
    }
}
