<?php

namespace App\Services\Thread;

use App\Repositories\ThreadRepository;
use Mi\L5Core\Services\BaseService;

class DeleteThreadService extends BaseService
{
    public function __construct(ThreadRepository $repository)
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
