<?php

namespace App\Http\Resources\Setting;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
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
            'note',
            'image',
            'image_url',
            'is_use'
        ]);

        return $result;
    }
}
