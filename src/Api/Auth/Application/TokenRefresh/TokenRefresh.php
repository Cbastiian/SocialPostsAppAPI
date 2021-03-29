<?php

declare(strict_types=1);

namespace Src\Api\Auth\Application\TokenRefresh;

use Src\Api\Auth\Domain\Contracts\AuthRepository;

final class TokenRefresh
{
    private AuthRepository $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function __invoke()
    {
        return $this->authRepository->refresh();
    }
}
