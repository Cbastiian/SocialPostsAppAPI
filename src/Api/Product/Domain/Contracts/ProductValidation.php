<?php

namespace Src\Api\Product\Domain\Contracts;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Product\Domain\ValueObjects\Title;

interface ProductValidation
{
    public function throwIfProductNameAlreadyExist(UserId $userId, Title $title);
}
