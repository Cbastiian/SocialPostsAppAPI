<?php

namespace Src\Api\Auth\Domain\Contracts;

interface AuthValidation
{
    public function throwIfInvalidCredentials($token);
}
