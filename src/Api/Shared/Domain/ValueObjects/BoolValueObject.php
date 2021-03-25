<?php

declare(strict_types=1);

namespace Src\Api\Shared\Domain\ValueObjects;

abstract class BoolValueObject
{
    protected bool $value;

    public function __construct(bool $value)
    {
        $this->value = $value;
    }

    public function value(): bool
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string) $this->value();
    }
}
