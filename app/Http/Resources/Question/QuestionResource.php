<?php

namespace App\Http\Resources\Question;

use App\Http\Resources\Answer\AnswerResource;
use App\Http\Resources\Test\TestResource;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */

    public function toArray($request)
    {
        $result = $this->resource->only([
            'id',
            'content',
            'type',
            'sort_order',
            'test_id'
        ]);

        $result['test'] = TestResource::collection($this->whenLoaded('test'));
        $result['answers'] = AnswerResource::collection($this->whenLoaded('answers'));

        return $result;
    }
}
