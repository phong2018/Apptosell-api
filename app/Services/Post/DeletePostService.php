<?php

namespace App\Services\Post;

use App\Repositories\PostRepository;
use Mi\L5Core\Services\BaseService;

class DeletePostService extends BaseService
{
    public function __construct(PostRepository $repository)
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
