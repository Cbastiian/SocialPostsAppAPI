<?php

declare(strict_types=1);

namespace Src\Api\Shared\Domain\ValueObjects;

abstract class FloatValueObject
{
    protected float $value;

    public function __construct(float $value)
    {
        $this->value = $value;
    }

    public function value(): float
    {
        return $this->value;
    }

    public function isBiggerThan(FloatValueObject $other): bool
    {
        return $this->value() > $other->value();
    }

    public function __toString(): string
    {
        return (string) $this->value();
    }
}
