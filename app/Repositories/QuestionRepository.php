<?php

namespace App\Repositories;

use App\Models\Question;
use Mi\L5Core\Repositories\BaseRepository;

class QuestionRepository extends BaseRepository
{
    /**
     * Get the model of repository
     *
     * @return string
     */
    public function getModel()
    {
        return Question::class;
    }

    public function allowRelations()
    {
        return [
            'anwsers',
            'test'
        ];
    }

    public function getOrderableFields()
    {
        return [
            'created_at',
            'sort_order',
            'id'
        ];
    }
}
