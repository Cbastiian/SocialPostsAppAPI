<?php

declare(strict_types=1);

namespace Src\Api\Shared\Domain\Contracts;

interface CommandHandler
{
    public function execute($command);
}
