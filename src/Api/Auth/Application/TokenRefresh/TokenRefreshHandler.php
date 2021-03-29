<?php

declare(strict_types=1);

namespace Src\Api\Auth\Application\TokenRefresh;

use Src\Api\Shared\Domain\Contracts\CommandHandler;

final class TokenRefreshHandler implements CommandHandler
{
    private TokenRefresh $tokenRefresh;

    public  function __construct(TokenRefresh $tokenRefresh)
    {
        $this->tokenRefresh = $tokenRefresh;
    }

    public function execute($command)
    {
        return $this->tokenRefresh->__invoke();
    }
}
