<?php

namespace Src\Api\Product\Domain\Contracts;

use Src\Api\Product\Domain\ProductEntity;
use Src\Api\Shared\Domain\ValueObjects\Image;
use Src\Api\Shared\Domain\ValueObjects\Status;
use Src\Api\User\Domain\ValueObjects\Username;
use Src\Api\Product\Domain\ValueObjects\ProductId;
use Src\Api\Product\Domain\ValueObjects\ProductCode;

interface ProductRepository
{
    public function saveProduct(ProductEntity $productEntity);
    public function updateProduct(ProductId $productId, ProductEntity $productEntity);
    public function changeProductStatus(ProductId $productId, Status $status);
    public function changeProductImage(ProductId $productId, Image $image);
    public function getGeneralProducts();
    public function getProductsByUser(Username $username);
    public function getProductByCode(ProductCode $productCode);
    public function findProductById(ProductId $productId);
}
