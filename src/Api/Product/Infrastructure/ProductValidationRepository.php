<?php

namespace Src\Api\Product\Infrastructure;

use App\Models\Product;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Product\Domain\ValueObjects\Title;
use Src\Api\Product\Domain\Contracts\ProductValidation;
use Src\Api\Product\Domain\Exceptions\SameProductNameError;

final class ProductValidationRepository implements ProductValidation
{
    public function throwIfProductNameAlreadyExist(UserId $userId, Title $title)
    {
        $product = $this->findProductNameByUser($userId, $title);

        if ($product) throw new SameProductNameError($title);
    }

    public function findProductNameByUser(UserId $userId, Title $title)
    {
        return Product::where([
            ['title', $title->value()],
            ['user_id', $userId->value()]
        ])->first();
    }
}
