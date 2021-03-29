<?php

namespace Src\Api\Auth\Infrastructure;

use Src\Api\Auth\Domain\Contracts\AuthValidation;
use Src\Api\Auth\Domain\Exceptions\InvalidCredentials;

final class AuthValidationRepository implements AuthValidation
{
    public function throwIfInvalidCredentials($token)
    {
        if (!$token) throw new InvalidCredentials();
    }
}
