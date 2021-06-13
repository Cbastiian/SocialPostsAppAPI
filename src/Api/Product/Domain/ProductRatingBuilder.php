<?php

declare(strict_types=1);

namespace Src\Api\Product\Domain;

use phpDocumentor\Reflection\Types\This;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Product\Domain\ValueObjects\Value;
use Src\Api\Product\Domain\ValueObjects\ProductId;
use Src\Api\Product\Domain\ValueObjects\UserComment;
use Src\Api\Product\Domain\Contracts\ProductRatingBuilderInterface;

final class ProductRatingBuilder implements ProductRatingBuilderInterface
{
    private ProductRatingEntity $productRatingEntity;

    private Value $value;
    private ProductId $productId;
    private UserId $userId;
    private UserComment $userComment;

    public function __construct()
    {
        $this->productRatingEntity = new ProductRatingEntity();
    }

    public function buildCreateProductRating(): ProductRatingEntity
    {
        $this->productRatingEntity->setValue($this->value);
        $this->productRatingEntity->setProductId($this->productId);
        $this->productRatingEntity->setUserId($this->userId);
        $this->productRatingEntity->setUserComment($this->userComment);

        return $this->productRatingEntity;
    }

    public function buildUpdateProductRating(): ProductRatingEntity
    {
        $this->productRatingEntity->setValue($this->value);
        $this->productRatingEntity->setUserComment($this->userComment);

        return $this->productRatingEntity;
    }

    /***
     * with the value of value 
     */
    public function withValue(Value $value)
    {
        $this->value = $value;

        return $this;
    }

    /***
     * with  the value of productId
     */
    public function withProductId(ProductId $productId)
    {
        $this->productId = $productId;

        return $this;
    }

    /***
     * with  the value of userId
     */
    public function withUserId(UserId $userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /***
     * with  the value of userComment
     */
    public function withUserComment(UserComment $userComment)
    {
        $this->userComment = $userComment;

        return $this;
    }
}
