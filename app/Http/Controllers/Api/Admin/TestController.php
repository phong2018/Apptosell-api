<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Test\CreateTestRequest;
use App\Http\Requests\Admin\Test\ListTestRequest;
use App\Http\Requests\Admin\Test\ShowTestRequest;
use App\Http\Requests\Admin\Test\UpdateTestRequest;
use App\Http\Resources\Test\TestCollection;
use App\Http\Resources\Test\TestResource;
use App\Models\Test;
use App\Services\Test\CreateTestService;
use App\Services\Test\ListTestService;
use App\Services\Test\ShowTestService;
use App\Services\Test\UpdateTestService;
use App\Services\Test\DeleteTestService;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ListTestRequest $request)
    {
        $tests = resolve(ListTestService::class)->setRequest($request)->handle();
        return response()->success(new TestCollection($tests));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTestRequest $request)
    {
        $test = resolve(CreateTestService::class)->setRequest($request)->handle();
        return response()->success(new TestResource($test));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(ShowTestRequest $request, int $id)
    {
        $test = resolve(ShowTestService::class)->setRequest($request)->setModel($id)->handle();
        return response()->success(new TestResource($test));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function update(UpdateTestRequest $request, int $id)
    {
        $test = resolve(ShowTestService::class)->setRequest($request)->setModel($id)->handle();
        $testUpdated = resolve(UpdateTestService::class)->setRequest($request)->setModel($test)->handle();
        return response()->success(new TestResource($testUpdated));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {
        resolve(DeleteTestService::class)->setModel($test)->handle();
        return response()->successWithoutData();
    }
}
