<?php

namespace App\Services\Admin;

use App\Models\Admin;
use App\Repositories\AdminRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Mi\L5Core\Services\BaseService;

class DeleteAdminService extends BaseService
{
    protected $resvRepository;

    public function __construct(
        AdminRepository $repository
    ) {
        $this->repository     = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $admin = Admin::find($this->model);
        throw_if(!$admin, new ModelNotFoundException());
        return $admin->delete();
    }
}
