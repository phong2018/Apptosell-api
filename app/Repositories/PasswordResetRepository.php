<?php

namespace App\Repositories;

use App\Models\PasswordReset;
use Mi\L5Core\Repositories\BaseRepository;

class PasswordResetRepository extends BaseRepository
{
    /**
     * Get the model of repository
     *
     * @return string
     */
    public function getModel()
    {
        return PasswordReset::class;
    }
}
