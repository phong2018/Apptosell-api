<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Test\ListTestRequest;
use App\Http\Resources\Test\TestCollection;
use App\Services\Test\ListTestService;

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
}
