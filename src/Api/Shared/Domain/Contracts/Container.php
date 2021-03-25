<?php

declare(strict_types=1);

namespace Src\Api\Shared\Domain\Contracts;

interface Container
{
    public function make(string $class);
}
