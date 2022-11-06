<?php

namespace App\Services\Admin;

use App\Models\Admin;
use App\Repositories\AdminRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Mi\L5Core\Services\BaseService;

class UpdateAdminService extends BaseService
{
    protected $collectsData = true;

    public function __construct(
        AdminRepository $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $admin = Admin::find($this->model);
        throw_if(!$admin, new ModelNotFoundException());

        $dataAdmin = $this->data->only([
            'name',
            'email',
            'permission'
        ])->toArray();

        return $admin->update($dataAdmin);
    }
}
