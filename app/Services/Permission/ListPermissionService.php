<?php

namespace App\Services\Permission;

use Illuminate\Support\Facades\Route;
use Mi\L5Core\Services\BaseService;

class ListPermissionService extends BaseService
{
    protected $collectsData = true;

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $result = [];
        $permissions = Route::getRoutes()->getRoutesByName();
        foreach($permissions as $name => $val) { //phpcs:ignore
            $val = '';
            $arr = explode('.', $name);
            if ($arr[0] == $this->data->get('role')) {
                $result[] = $name;
            }
        }
        return $result;
    }
}
