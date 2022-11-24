<?php

namespace App\Services\Role;

use App\Repositories\RoleRepository;
use Mi\L5Core\Services\BaseService;

class UpdateRoleService extends BaseService
{
    protected $collectsData = true;

    public function __construct(
        RoleRepository $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $data = $this->data->all();
        return $this->repository->update($this->model->id, $data);
    }
}
