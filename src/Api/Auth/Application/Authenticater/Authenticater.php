<?php

declare(strict_types=1);

namespace Src\Api\Auth\Application\Authenticater;

use Src\Api\User\Domain\ValueObjects\Password;
use Src\Api\User\Domain\ValueObjects\Username;
use Src\Api\Auth\Domain\Contracts\AuthRepository;
use Src\Api\Auth\Domain\ValueObjects\Credentials;

final class Authenticater
{
    private AuthRepository $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function __invoke(
        Username $username,
        Password $password
    ) {
        $credentials = new Credentials([
            'username' => $username->value(),
            'password' => $password->value(),
            'active' => intval(true)
        ]);

        return $this->authRepository->login($credentials);
    }
}
