<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Answer\CreateAnswerRequest;
use App\Http\Requests\Admin\Answer\ListAnswerRequest;
use App\Http\Requests\Admin\Answer\ShowAnswerRequest;
use App\Http\Requests\Admin\Answer\UpdateAnswerRequest;
use App\Http\Resources\Answer\AnswerCollection;
use App\Http\Resources\Answer\AnswerResource;
use App\Models\Answer;
use App\Services\Answer\CreateAnswerService;
use App\Services\Answer\ListAnswerService;
use App\Services\Answer\ShowAnswerService;
use App\Services\Answer\UpdateAnswerService;
use App\Services\Answer\DeleteAnswerService;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ListAnswerRequest $request)
    {
        $answers = resolve(ListAnswerService::class)->setRequest($request)->handle();
        return response()->success(new AnswerCollection($answers));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAnswerRequest $request)
    {
        $answer = resolve(CreateAnswerService::class)->setRequest($request)->handle();
        return response()->success(new AnswerResource($answer));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(ShowAnswerRequest $request, int $id)
    {
        $answer = resolve(ShowAnswerService::class)->setRequest($request)->setModel($id)->handle();
        return response()->success(new AnswerResource($answer));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function update(UpdateAnswerRequest $request, int $id)
    {
        $answer = resolve(ShowAnswerService::class)->setRequest($request)->setModel($id)->handle();
        $answerUpdated = resolve(UpdateAnswerService::class)->setRequest($request)->setModel($answer)->handle();
        return response()->success(new AnswerResource($answerUpdated));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        resolve(DeleteAnswerService::class)->setModel($answer)->handle();
        return response()->successWithoutData();
    }
}
