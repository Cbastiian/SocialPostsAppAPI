<?php

declare(strict_types=1);

namespace Src\Api\Shared\Domain\Contracts;

interface CommandBus
{
    public function execute(Command $command);
}
