<?php

namespace App\Services\Test;

use App\Common\Image;
use App\Repositories\TestRepository;
use Illuminate\Support\Facades\DB;
use Mi\L5Core\Services\BaseService;

class CreateTestService extends BaseService
{
    protected $collectsData = true;

    public function __construct(
        TestRepository $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $data = $this->data->all();
        if (isset($data['image'])) {
            $data['image'] = Image::generateStorageImage($data['image']);
        }
        return DB::transaction(function () use ($data) {
            $test = $this->repository->create($data);
            return $test;
        });
    }
}
