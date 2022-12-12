<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Thread\CreateThreadRequest;
use App\Http\Requests\Admin\Thread\ListThreadRequest;
use App\Http\Requests\Admin\Thread\ShowThreadRequest;
use App\Http\Requests\Admin\Thread\UpdateThreadRequest;
use App\Http\Resources\Thread\ThreadCollection;
use App\Http\Resources\Thread\ThreadResource;
use App\Models\Thread;
use App\Services\Thread\CreateThreadService;
use App\Services\Thread\DeleteThreadService;
use App\Services\Thread\ListThreadService;
use App\Services\Thread\ShowThreadService;
use App\Services\Thread\UpdateThreadService;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ListThreadRequest $request)
    {
        $threads = resolve(ListThreadService::class)->setRequest($request)->handle();
        return response()->success(new ThreadCollection($threads));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateThreadRequest $request)
    {
        $thread = resolve(CreateThreadService::class)->setRequest($request)->handle();
        return response()->success(new ThreadResource($thread));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(ShowThreadRequest $request, int $id)
    {
        $thread = resolve(ShowThreadService::class)->setRequest($request)->setModel($id)->handle();
        return response()->success(new ThreadResource($thread));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function update(UpdateThreadRequest $request, int $id)
    {
        $thread = resolve(ShowThreadService::class)->setRequest($request)->setModel($id)->handle();
        $threadUpdated = resolve(UpdateThreadService::class)->setRequest($request)->setModel($thread)->handle();
        return response()->success(new ThreadResource($threadUpdated));
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {
        resolve(DeleteThreadService::class)->setModel($thread)->handle();
        return response()->successWithoutData();
    }
}
