<?php

namespace Src\Api\Product\Domain\Contracts;

use Src\Api\Product\Domain\ProductRatingEntity;

interface ProductRatingBuilderInterface
{
    public function buildCreateProductRating(): ProductRatingEntity;
    public function buildUpdateProductRating(): ProductRatingEntity;
}
