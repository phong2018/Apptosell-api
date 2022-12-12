<?php

namespace App\Repositories;

use App\Models\Thread;
use Mi\L5Core\Repositories\BaseRepository;

class ThreadRepository extends BaseRepository
{
    /**
     * Get the model of repository
     *
     * @return string
     */
    public function getModel()
    {
        return Thread::class;
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
