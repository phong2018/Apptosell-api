<?php

namespace App\Repositories;

use App\Models\Role;
use Mi\L5Core\Repositories\BaseRepository;

class RoleRepository extends BaseRepository
{
    /**
     * Get the model of repository
     *
     * @return string
     */
    public function getModel()
    {
        return Role::class;
    }

    public function allowRelations()
    {
        return [];
    }

    public function getOrderableFields()
    {
        return [
            'created_at',
            'id'
        ];
    }
}
