<?php

namespace App\Services\ServiceMenu;

use App\Repositories\ServiceMenuRepository;
use Mi\L5Core\Criteria\WithRelationsCriteria;
use Mi\L5Core\Services\BaseService;

class ShowServiceMenuService extends BaseService
{
    protected $collectsData = true;

    public function __construct(ServiceMenuRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        return $this->repository->pushCriteria(
            new WithRelationsCriteria($this->data->get('with'), $this->repository->allowRelations())
        )->find($this->model);
    }
}
