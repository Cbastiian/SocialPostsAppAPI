<?php

declare(strict_types=1);

namespace Src\Api\Shared\Domain\ValueObjects;

abstract class ArrayValueObject
{
    protected ?array $value;

    public function __construct(?array $value)
    {
        $this->value = $value;
    }

    public function value(): ?array
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string) $this->value();
    }
}
