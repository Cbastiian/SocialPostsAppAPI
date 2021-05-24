<?php

declare(strict_types=1);

namespace Src\Api\Product\Domain;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Product\Domain\ValueObjects\Value;
use Src\Api\Product\Domain\ValueObjects\ProductId;
use Src\Api\Product\Domain\ValueObjects\UserComment;

final class ProductRatingEntity
{
    private Value $value;
    private ProductId $productId;
    private UserId $userId;
    private UserComment $userComment;

    public function toCreateArray(): array
    {
        return [
            'value' => $this->getValue()->value(),
            'product_id' => $this->getProductId()->value(),
            'user_id' => $this->getUserId()->value(),
            'comment' => $this->getUserComment()->value()
        ];
    }

    public function toUpdateArray(): array
    {
        return [
            'value' => $this->getValue()->value(),
            'comment' => $this->getUserComment()->value()
        ];
    }

    /***
     * get the value of value
     */
    public function getValue(): Value
    {
        return $this->value;
    }

    /***
     * set the value of value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }


    /***
     * get the value of productId
     */
    public function getProductId(): ProductId
    {
        return $this->productId;
    }

    /***
     * set the value of productId
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
    }


    /***
     * get the value of userId
     */
    public function getUserId(): UserId
    {
        return $this->userId;
    }

    /***
     * set the value of userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }


    /***
     * get the value of userComment
     */
    public function getUserComment(): UserComment
    {
        return $this->userComment;
    }

    /***
     * set the value of userComment
     */
    public function setUserComment($userComment)
    {
        $this->userComment = $userComment;
    }
}
