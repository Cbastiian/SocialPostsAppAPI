<?php

namespace Src\Api\Product\Infrastructure;

use App\Models\Product;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Product\Domain\ValueObjects\Title;
use Src\Api\Product\Domain\ValueObjects\ProductId;
use Src\Api\Product\Domain\ValueObjects\ProductCode;
use Src\Api\Product\Domain\Contracts\ProductValidation;
use Src\Api\Product\Domain\Exceptions\NotProductOwnerError;
use Src\Api\Product\Domain\Exceptions\ProductNotExistError;
use Src\Api\Product\Domain\Exceptions\SameProductNameError;
use Src\Api\Product\Domain\Exceptions\ProductCodeNotFoundError;

final class ProductValidationRepository implements ProductValidation
{
    public function throwIfProductNameAlreadyExist(UserId $userId, Title $title)
    {
        $product = $this->findProductNameByUser($userId, $title);

        if ($product) throw new SameProductNameError($title);
    }

    public function throwIfProductIdNotExist(ProductId $productId)
    {
        $product = $this->findProductById($productId);

        if ($product == null) throw new ProductNotExistError($productId);
    }

    public function throwIfProductUpdateTitleAlreadyExist(Title $title, ProductId $productId)
    {
        $product = $this->findProductById($productId);
        $userId = new UserId($product->user_id);

        if (!($product->title == $title->value())) {
            $existProduct = $this->findProductNameByUser($userId, $title);
            if ($existProduct) throw new SameProductNameError($title);
        }
    }

    public function throwIfNotProductOwner(ProductId $productId, UserId $userId)
    {
        $product = $this->findProductById($productId);

        if ($product->user_id != $userId->value()) throw new NotProductOwnerError($productId, $userId);
    }

    public function throwIfProductCodeNotExist(ProductCode $productCode)
    {
        $product = $this->findProductByCode($productCode);

        if ($product == null) throw new ProductCodeNotFoundError($productCode);
    }

    private function findProductNameByUser(UserId $userId, Title $title)
    {
        return Product::where([
            ['title', $title->value()],
            ['user_id', $userId->value()]
        ])->first();
    }

    private function findProductById(ProductId $productId)
    {
        return Product::where('id', $productId->value())->first();
    }

    public function findProductByCode(ProductCode $productCode)
    {
        return Product::where('product_code', $productCode->value())->first();
    }
}
