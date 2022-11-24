<?php

namespace App\Repositories;

use App\Models\Setting;
use Mi\L5Core\Repositories\BaseRepository;

class SettingRepository extends BaseRepository
{
    /**
     * Get the model of repository
     *
     * @return string
     */
    public function getModel()
    {
        return Setting::class;
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
