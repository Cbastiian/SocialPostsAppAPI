<?php

declare(strict_types=1);

namespace Src\Api\Auth\Application\Unauthenticater;

use Src\Api\Shared\Domain\Contracts\CommandHandler;

final class UnauthenticateHandler implements CommandHandler
{
    private Unauthenticater $unauthenticater;

    public function __construct(Unauthenticater $unauthenticater)
    {
        $this->unauthenticater = $unauthenticater;
    }

    public function execute($command)
    {
        $this->unauthenticater->__invoke();
    }
}
