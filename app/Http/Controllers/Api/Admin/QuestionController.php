<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Question\CreateQuestionRequest;
use App\Http\Requests\Admin\Question\ListQuestionRequest;
use App\Http\Requests\Admin\Question\ShowQuestionRequest;
use App\Http\Requests\Admin\Question\UpdateQuestionRequest;
use App\Http\Resources\Question\QuestionCollection;
use App\Http\Resources\Question\QuestionResource;
use App\Models\Question;
use App\Services\Question\CreateQuestionService;
use App\Services\Question\ListQuestionService;
use App\Services\Question\ShowQuestionService;
use App\Services\Question\UpdateQuestionService;
use App\Services\Question\DeleteQuestionService;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ListQuestionRequest $request)
    {
        $questions = resolve(ListQuestionService::class)->setRequest($request)->handle();
        return response()->success(new QuestionCollection($questions));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateQuestionRequest $request)
    {
        $question = resolve(CreateQuestionService::class)->setRequest($request)->handle();
        return response()->success(new QuestionResource($question));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(ShowQuestionRequest $request, int $id)
    {
        $question = resolve(ShowQuestionService::class)->setRequest($request)->setModel($id)->handle();
        return response()->success(new QuestionResource($question));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function update(UpdateQuestionRequest $request, int $id)
    {
        $question = resolve(ShowQuestionService::class)->setRequest($request)->setModel($id)->handle();
        $questionUpdated = resolve(UpdateQuestionService::class)->setRequest($request)->setModel($question)->handle();
        return response()->success(new QuestionResource($questionUpdated));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        resolve(DeleteQuestionService::class)->setModel($question)->handle();
        return response()->successWithoutData();
    }
}
