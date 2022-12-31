<?php

namespace App\Services\Answer;

use App\Repositories\AnswerRepository;
use Mi\L5Core\Services\BaseService;

class DeleteAnswerService extends BaseService
{
    public function __construct(AnswerRepository $repository)
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
