<?php

namespace App\Services\Auth\Traits;

use App\Enums\ExceptionTypes;
use App\Models\Factory;
use Illuminate\Auth\AuthenticationException;

trait CheckValidFactory
{
    public function isValidFactory($factoryId)
    {
        $factory = Factory::find($factoryId);
        throw_if(!$factory, new AuthenticationException(ExceptionTypes::INVALID_LOGIN_CREDENTIALS));
    }
}
