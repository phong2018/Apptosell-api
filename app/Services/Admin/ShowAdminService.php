<?php

namespace App\Services\Admin;

use App\Repositories\AdminRepository;
use Mi\L5Core\Criteria\WithRelationsCriteria;
use Mi\L5Core\Services\BaseService;

class ShowAdminService extends BaseService
{
    protected $collectsData = true;

    public function __construct(AdminRepository $repository)
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
