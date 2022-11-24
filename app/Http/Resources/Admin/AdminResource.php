<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\Role\RoleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
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
            'is_super_admin',
            'email',
            'permission',
            'role_id'
        ]);

        $result['role'] = new RoleResource($this->whenLoaded('role'));

        return $result;
    }
}
