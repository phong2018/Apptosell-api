<?php

namespace App\Http\Controllers\Api\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guest\Permission\ListPermissionRequest;
use App\Services\Permission\ListPermissionService;

class PermissionController extends Controller
{
    /**
     * Get permission by role
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ListPermissionRequest $request)
    {
        return resolve(ListPermissionService::class)->setRequest($request)->handle();
    }
}
