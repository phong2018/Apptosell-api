<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\CreateRoleRequest;
use App\Http\Requests\Admin\Role\ListRoleRequest;
use App\Http\Requests\Admin\Role\ShowRoleRequest;
use App\Http\Requests\Admin\Role\UpdateRoleRequest;
use App\Http\Resources\Role\RoleCollection;
use App\Http\Resources\Role\RoleResource;

use App\Services\Role\CreateRoleService;
use App\Services\Role\ListRoleService;
use App\Services\Role\ShowRoleService;
use App\Services\Role\UpdateRoleService;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ListRoleRequest $request)
    {
        $roles = resolve(ListRoleService::class)->setRequest($request)->handle();
        return response()->success(new RoleCollection($roles));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoleRequest $request)
    {
        $role = resolve(CreateRoleService::class)->setRequest($request)->handle();
        return response()->success(new RoleResource($role));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(ShowRoleRequest $request, int $id)
    {
        $role = resolve(ShowRoleService::class)->setRequest($request)->setModel($id)->handle();
        return response()->success(new RoleResource($role));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function update(UpdateRoleRequest $request, int $id)
    {
        $role = resolve(ShowRoleService::class)->setRequest($request)->setModel($id)->handle();
        $roleUpdated = resolve(UpdateRoleService::class)->setRequest($request)->setModel($role)->handle();
        return response()->success(new RoleResource($roleUpdated));
    }
}
