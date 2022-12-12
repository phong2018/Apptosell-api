<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Thread\ThreadResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'description',
            'content',
            'sort_order',
            'status',
            'image',
            'image_url',
            'publish_date'
        ]);

        $result['threads'] = ThreadResource::collection($this->whenLoaded('threads'));

        return $result;
    }
}
