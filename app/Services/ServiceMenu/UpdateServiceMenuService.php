<?php

namespace App\Services\ServiceMenu;

use App\Common\Image;
use App\Repositories\ServiceMenuRepository;
use Mi\L5Core\Services\BaseService;

class UpdateServiceMenuService extends BaseService
{
    protected $collectsData = true;

    public function __construct(
        ServiceMenuRepository $repository
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
            if ($this->model->image) {
                Image::deleteStorageImage($this->model->image);
            }
            $data['image'] = Image::generateStorageImage($data['image']);
        }
        return $this->repository->update($this->model->id, $data);
    }
}
