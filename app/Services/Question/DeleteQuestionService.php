<?php

namespace App\Services\Question;

use App\Repositories\QuestionRepository;
use Mi\L5Core\Services\BaseService;

class DeleteQuestionService extends BaseService
{
    public function __construct(QuestionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $this->model->answers()->delete();
        return $this->model->delete();
    }
}
