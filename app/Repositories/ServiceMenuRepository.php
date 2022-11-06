<?php

namespace App\Repositories;

use App\Models\ServiceMenu;
use Mi\L5Core\Repositories\BaseRepository;

class ServiceMenuRepository extends BaseRepository
{
    /**
     * Get the model of repository
     *
     * @return string
     */
    public function getModel()
    {
        return ServiceMenu::class;
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
