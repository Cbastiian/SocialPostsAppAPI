<?php

namespace Src\Api\Product\Domain\Exceptions;

use Src\Api\Product\Domain\ValueObjects\Title;
use Src\Api\Shared\Domain\Exceptions\DomainError;

final class SameProductNameError extends DomainError
{
    private Title $title;

    public function __construct(Title $title)
    {
        $this->title = $title;
    }

    public function errorCode(): string
    {
        return 'SAME_PRODUCT_TITLE';
    }

    public function errorMessage(): string
    {
        return 'The product title ' . $this->title->value() . ' Already exist';
    }
}
