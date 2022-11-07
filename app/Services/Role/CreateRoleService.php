<?php

namespace App\Services\Role;

use App\Common\Image;
use App\Repositories\RoleRepository;
use Mi\L5Core\Services\BaseService;

class CreateRoleService extends BaseService
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
        return $this->repository->create($data);
    }
}
