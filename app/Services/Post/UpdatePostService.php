<?php

namespace App\Services\Post;

use App\Common\Image;
use App\Repositories\SettingRepository;
use Illuminate\Support\Facades\DB;
use Mi\L5Core\Services\BaseService;

class UpdatePostService extends BaseService
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
        $data = $this->data->all();
        if (isset($data['image'])) {
            if ($this->model->image) {
                Image::deleteStorageImage($this->model->image);
            }
            $data['image'] = Image::generateStorageImage($data['image']);
        }
        return DB::transaction(function () use ($data) {
            $this->repository->update($this->model->id, $data);
            if ($this->data->get('threads')) {
                $this->model->threads()->sync($this->data->get('threads'));
            }
            return $this->model;
        });

        return $this->repository->update($this->model->id, $data);
    }
}
