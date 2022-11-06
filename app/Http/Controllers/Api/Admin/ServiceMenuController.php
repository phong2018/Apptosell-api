<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceMenu\CreateServiceMenuRequest;
use App\Http\Requests\Admin\ServiceMenu\ListServiceMenuRequest;
use App\Http\Requests\Admin\ServiceMenu\ShowServiceMenuRequest;
use App\Http\Requests\Admin\ServiceMenu\UpdateServiceMenuRequest;
use App\Http\Resources\ServiceMenu\ServiceMenuCollection;
use App\Http\Resources\ServiceMenu\ServiceMenuResource;

use App\Services\ServiceMenu\CreateServiceMenuService;
use App\Services\ServiceMenu\ListServiceMenuService;
use App\Services\ServiceMenu\ShowServiceMenuService;
use App\Services\ServiceMenu\UpdateServiceMenuService;

class ServiceMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ListServiceMenuRequest $request)
    {
        $serviceMenus = resolve(ListServiceMenuService::class)->setRequest($request)->handle();
        return response()->success(new ServiceMenuCollection($serviceMenus));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateServiceMenuRequest $request)
    {
        $serviceMenu = resolve(CreateServiceMenuService::class)->setRequest($request)->handle();
        return response()->success(new ServiceMenuResource($serviceMenu));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(ShowServiceMenuRequest $request, int $id)
    {
        $serviceMenu = resolve(ShowServiceMenuService::class)->setRequest($request)->setModel($id)->handle();
        return response()->success(new ServiceMenuResource($serviceMenu));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function update(UpdateServiceMenuRequest $request, int $id)
    {
        $serviceMenu = resolve(ShowServiceMenuService::class)->setRequest($request)->setModel($id)->handle();
        $serviceMenuUpdated = resolve(UpdateServiceMenuService::class)->setRequest($request)->setModel($serviceMenu)->handle();
        return response()->success(new ServiceMenuResource($serviceMenuUpdated));
    }
}
