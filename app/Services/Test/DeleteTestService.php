<?php

namespace App\Services\Test;

use App\Repositories\TestRepository;
use Mi\L5Core\Services\BaseService;

class DeleteTestService extends BaseService
{
    public function __construct(TestRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        foreach ($this->model->questions() as $question) {
            $question->answers()->delete();
        }
        $this->model->questions()->delete();
        return $this->model->delete();
    }
}
