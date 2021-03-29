<?php

namespace Src\Api\Auth\Domain\Contracts;

use Src\Api\Auth\Domain\ValueObjects\Credentials;

interface AuthRepository
{
    public function login(Credentials $credentials);
}
