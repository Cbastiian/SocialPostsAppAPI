<?php

declare(strict_types=1);

namespace Src\Api\Shared\Infrastructure;

use Src\Api\Shared\Domain\Contracts\Command;
use Src\Api\Shared\Domain\Contracts\CommandBus;
use Src\Api\Shared\Domain\Contracts\Container;

final class SimpleCommandBus implements CommandBus
{
    private const COMMAND_PREFIX = 'Command';
    private const HANDLER_PREFIX = 'Handler';

    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function execute($command)
    {
        $handler = $this->resolveHandler($command);
        return $handler->execute($command);
    }

    public function resolveHandler(Command $command)
    {
        $handlerClass = $this->getHandlerClass($command);
        return $this->container->make($handlerClass);
    }

    public function getHandlerClass(Command $command): string
    {
        return str_replace(self::COMMAND_PREFIX, self::HANDLER_PREFIX, get_class($command));
    }
}
