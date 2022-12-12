<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\CreatePostRequest;
use App\Http\Requests\Admin\Post\ListPostRequest;
use App\Http\Requests\Admin\Post\ShowPostRequest;
use App\Http\Requests\Admin\Post\UpdatePostRequest;
use App\Http\Resources\Post\PostCollection;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use App\Services\Post\CreatePostService;
use App\Services\Post\ListPostService;
use App\Services\Post\ShowPostService;
use App\Services\Post\UpdatePostService;
use App\Services\Setting\DeletePostService;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ListPostRequest $request)
    {
        $posts = resolve(ListPostService::class)->setRequest($request)->handle();
        return response()->success(new PostCollection($posts));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $post = resolve(CreatePostService::class)->setRequest($request)->handle();
        return response()->success(new PostResource($post));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(ShowPostRequest $request, int $id)
    {
        $post = resolve(ShowPostService::class)->setRequest($request)->setModel($id)->handle();
        return response()->success(new PostResource($post));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function update(UpdatePostRequest $request, int $id)
    {
        $post = resolve(ShowPostService::class)->setRequest($request)->setModel($id)->handle();
        $postUpdated = resolve(UpdatePostService::class)->setRequest($request)->setModel($post)->handle();
        return response()->success(new PostResource($postUpdated));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        resolve(DeletePostService::class)->setModel($post)->handle();
        return response()->successWithoutData();
    }
}
