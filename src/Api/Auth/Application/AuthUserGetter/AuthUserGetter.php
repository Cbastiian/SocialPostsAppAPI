<?php

declare(strict_types=1);

namespace Src\Api\Auth\Application\AuthUserGetter;

use Src\Api\Auth\Domain\Contracts\AuthRepository;

final class AuthUserGetter
{
    private AuthRepository $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function __invoke()
    {
        return $this->authRepository->me();
    }
}
