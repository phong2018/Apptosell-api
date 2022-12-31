<?php

namespace App\Repositories;

use App\Models\Answer;
use Mi\L5Core\Repositories\BaseRepository;

class AnswerRepository extends BaseRepository
{
    /**
     * Get the model of repository
     *
     * @return string
     */
    public function getModel()
    {
        return Answer::class;
    }

    public function allowRelations()
    {
        return [
            'questions'
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
