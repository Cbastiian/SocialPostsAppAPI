<?php

declare(strict_types=1);

namespace Src\Api\Auth\Application\Unauthenticater;

use Src\Api\Auth\Domain\Contracts\AuthRepository;

final class Unauthenticater
{
    private AuthRepository $authRepoitory;

    public function __construct(AuthRepository $authRepoitory)
    {
        $this->authRepoitory = $authRepoitory;
    }

    public function __invoke()
    {
        $this->authRepoitory->logout();
    }
}
