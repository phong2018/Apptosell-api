<?php

namespace App\Http\Resources\Test;

use App\Http\Resources\Question\QuestionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TestResource extends JsonResource
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
            'name',
            'content',
            'result',
            'image',
            'status',
            'sort_order',
            'time_test',
            'image_url',
        ]);

        $result['questions'] = QuestionResource::collection($this->whenLoaded('questions'));

        return $result;
    }
}
