<?php

namespace Src\Api\Product\Domain\Contracts;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Product\Domain\ValueObjects\Title;
use Src\Api\Product\Domain\ValueObjects\ProductId;
use Src\Api\Product\Domain\ValueObjects\ProductCode;

interface ProductValidation
{
    public function throwIfProductNameAlreadyExist(UserId $userId, Title $title);
    public function throwIfProductIdNotExist(ProductId $productId);
    public function throwIfProductUpdateTitleAlreadyExist(Title $title, ProductId $productId);
    public function throwIfNotProductOwner(ProductId $productId, UserId $userId);
    public function throwIfProductCodeNotExist(ProductCode $productCode);
    public function throwIfProductAlreadyRated(ProductId $productId, UserId $userId);
    public function throwIfProductNotRated(ProductId $productId, UserId $userId);
    public function throwIfProductAlreadyInFavorites(ProductId $productId, UserId $userId);
    public function throwIfProductOwner(ProductId $productId, UserId $userId);
    public function throwIfProductNotInFavorites(ProductId $productId, UserId $userId);
}
