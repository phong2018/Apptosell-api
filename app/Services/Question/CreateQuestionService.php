<?php

namespace App\Services\Question;

use App\Repositories\QuestionRepository;
use Illuminate\Support\Facades\DB;
use Mi\L5Core\Services\BaseService;

class CreateQuestionService extends BaseService
{
    protected $collectsData = true;

    public function __construct(
        QuestionRepository $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $data = $this->data->all();

        return DB::transaction(function () use ($data) {
            $test = $this->repository->create($data);
            return $test;
        });
    }
}
