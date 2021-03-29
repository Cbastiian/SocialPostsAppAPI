<?php

declare(strict_types=1);

namespace Src\Api\Auth\Application\AuthUserGetter;

use Src\Api\Shared\Domain\Contracts\CommandHandler;

final class GetAuthUserHandler implements CommandHandler
{
    private AuthUserGetter $authUserGetter;

    public function __construct(AuthUserGetter $authUserGetter)
    {
        $this->authUserGetter = $authUserGetter;
    }

    public function execute($command)
    {
        return $this->authUserGetter->__invoke();
    }
}
