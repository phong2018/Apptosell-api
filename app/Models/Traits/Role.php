<?php

namespace App\Models\Traits;

use App\Models\Admin;
use App\Models\FactoryAccount;
use App\Models\Member;

trait Role
{
    /**
     * Check role Factory
     *
     * @return bool
     */
    public function isFactory()
    {
        if (get_class($this) == FactoryAccount::class) {
            return true;
        }

        return false;
    }

    /**
     * Check role Admin
     *
     * @return bool
     */
    public function isAdmin()
    {
        if (get_class($this) == Admin::class) {
            return true;
        }

        return false;
    }

    /**
     * Check role Member
     *
     * @return bool
     */
    public function isMember()
    {
        if (get_class($this) == Member::class) {
            return true;
        }

        return false;
    }
}
