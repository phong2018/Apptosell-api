<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Account\ChangePasswordRequest;
use App\Http\Requests\Admin\Account\CreateAdminRequest;
use App\Http\Requests\Admin\Account\ListAdminRequest;
use App\Http\Requests\Admin\Account\ShowAdminRequest;
use App\Http\Requests\Admin\Account\UpdateAdminRequest;
use App\Http\Resources\Admin\AdminCollection;
use App\Http\Resources\Admin\AdminResource;
use App\Services\Admin\ChangePasswordService;
use App\Services\Admin\CreateAdminService;
use App\Services\Admin\DeleteAdminService;
use App\Services\Admin\ListAdminService;
use App\Services\Admin\ShowAdminService;
use App\Services\Admin\UpdateAdminService;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ListAdminRequest $request)
    {
        $admins = resolve(ListAdminService::class)->setRequest($request)->handle();
        return response()->success(new AdminCollection($admins));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAdminRequest $request)
    {
        $respone = resolve(CreateAdminService::class)->setRequest($request)->handle();
        return response()->created($respone);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(ShowAdminRequest $request, int $id)
    {
        $admin = resolve(ShowAdminService::class)->setRequest($request)->setModel($id)->handle();
        return response()->success(new AdminResource($admin));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, int $id)
    {
        resolve(UpdateAdminService::class)->setRequest($request)->setModel($id)->handle();
        return response()->successWithoutData();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        resolve(DeleteAdminService::class)->setModel($id)->handle();
        return response()->successWithoutData();
    }

    /**
     * change password specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function changePassword(ChangePasswordRequest $request)
    {
        $result = resolve(ChangePasswordService::class)->setRequest($request)->handle();
        return response()->success($result);
    }

    /**
     * logout accout.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();

        return response()->successWithoutData();
    }
}
