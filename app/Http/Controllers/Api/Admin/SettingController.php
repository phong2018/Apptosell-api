<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\CreateSettingRequest;
use App\Http\Requests\Admin\Setting\ListSettingRequest;
use App\Http\Requests\Admin\Setting\ShowSettingRequest;
use App\Http\Requests\Admin\Setting\UpdateSettingRequest;
use App\Http\Resources\Setting\SettingCollection;
use App\Http\Resources\Setting\SettingResource;

use App\Services\Setting\CreateSettingService;
use App\Services\Setting\ListSettingService;
use App\Services\Setting\ShowSettingService;
use App\Services\Setting\UpdateSettingService;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ListSettingRequest $request)
    {
        $settings = resolve(ListSettingService::class)->setRequest($request)->handle();
        return response()->success(new SettingCollection($settings));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSettingRequest $request)
    {
        $setting = resolve(CreateSettingService::class)->setRequest($request)->handle();
        return response()->success(new SettingResource($setting));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(ShowSettingRequest $request, int $id)
    {
        $setting = resolve(ShowSettingService::class)->setRequest($request)->setModel($id)->handle();
        return response()->success(new SettingResource($setting));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function update(UpdateSettingRequest $request, int $id)
    {
        $setting = resolve(ShowSettingService::class)->setRequest($request)->setModel($id)->handle();
        $settingUpdated = resolve(UpdateSettingService::class)->setRequest($request)->setModel($setting)->handle();
        return response()->success(new SettingResource($settingUpdated));
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        return true;
    }
}
