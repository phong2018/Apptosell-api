<?php

namespace App\Repositories;

use App\Models\Test;
use Mi\L5Core\Repositories\BaseRepository;

class TestRepository extends BaseRepository
{
    /**
     * Get the model of repository
     *
     * @return string
     */
    public function getModel()
    {
        return Test::class;
    }

    public function allowRelations()
    {
        return [
            'questions',
            'questions.answers'
        ];
    }

    public function getOrderableFields()
    {
        return [
            'created_at',
            'id',
            'sort_order'
        ];
    }
}
