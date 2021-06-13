<?php

namespace Src\Api\Product\Application\ProductRatingUpdater;

use Src\Api\Shared\Domain\Contracts\Command;

final class UpdateProductRatingCommand implements Command
{
    private string $value;
    private int $productId;
    private int $userId;
    private ?string $comment;

    public function __construct(
        string $value,
        int $productId,
        int $userId,
        ?string $comment
    ) {
        $this->value = $value;
        $this->productId = $productId;
        $this->userId = $userId;
        $this->comment = $comment;
    }

    /***
     * get the value of value
     */
    public function getValue()
    {
        return $this->value;
    }


    /***
     * get the value of productId
     */
    public function getProductId()
    {
        return $this->productId;
    }


    /***
     * get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }


    /***
     * get the value of comment
     */
    public function getUserComment()
    {
        return $this->comment;
    }
}
