<?php

namespace App\Services\Thread;

use App\Repositories\ThreadRepository;
use Mi\L5Core\Services\BaseService;

class UpdateThreadService extends BaseService
{
    protected $collectsData = true;

    public function __construct(
        ThreadRepository $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        return $this->repository->update($this->model->id, $this->data->only([
            'name',
            'content',
            'sort_order',
            'status'
        ])->toArray());
    }
}
