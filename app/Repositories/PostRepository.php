<?php

namespace App\Repositories;

use App\Models\Post;
use Mi\L5Core\Repositories\BaseRepository;

class PostRepository extends BaseRepository
{
    /**
     * Get the model of repository
     *
     * @return string
     */
    public function getModel()
    {
        return Post::class;
    }

    public function allowRelations()
    {
        return [
            'threads'
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
