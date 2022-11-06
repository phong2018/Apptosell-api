<?php

namespace App\Repositories;

use App\Models\Admin;
use Mi\L5Core\Repositories\BaseRepository;

class AdminRepository extends BaseRepository
{
    /**
     * Get the model of repository
     *
     * @return string
     */
    public function getModel()
    {
        return Admin::class;
    }

    public function allowRelations()
    {
        return [

        ];
    }

    public function getOrderableFields()
    {
        return [
            'created_at',
            'id'
        ];
    }
}
