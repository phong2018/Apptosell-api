<?php

namespace App\Services\Answer;

use App\Filters\Id;
use App\Filters\Name;
use App\Filters\QuestionId;
use App\Repositories\AnswerRepository;
use Mi\L5Core\Criteria\FilterCriteria;
use Mi\L5Core\Criteria\OrderCriteria;
use Mi\L5Core\Criteria\WithRelationsCriteria;
use Mi\L5Core\Services\BaseService;

class ListAnswerService extends BaseService
{
    protected $collectsData = true;

    public function __construct(AnswerRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $data = $this->repository->pushCriteria(new FilterCriteria($this->data->toArray(), $this->allowFilters()))
        ->pushCriteria(new WithRelationsCriteria($this->data->get('with'), $this->repository->allowRelations()))
        ->pushCriteria(new OrderCriteria($this->data->get('order', '-id')));

        return $this->data->has('per_page')
            ? $data->paginate((int)$this->getPerPage())
            : $data->all();
    }

    private function allowFilters()
    {
        return [
            'id' => Id::class,
            'question_id' => QuestionId::class
        ];
    }
}
