<?php

namespace App\Http\Resources\Thread;

use Illuminate\Http\Resources\Json\JsonResource;

class ThreadResource extends JsonResource
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
            'sort_order',
            'status'
        ]);

        return $result;
    }
}
