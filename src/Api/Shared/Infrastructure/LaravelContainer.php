<?php

declare(strict_types=1);

namespace Src\Api\Shared\Infrastructure;

use Illuminate\Container\Container as IoC;
use Src\Api\Shared\Domain\Contracts\Container;

final class LaravelContainer implements Container
{
    private IoC $ioc;

    public function __construct(IoC $ioc)
    {
        $this->ioc = $ioc;
    }

    public function make(string $class)
    {
        return $this->ioc->make($class);
    }
}
