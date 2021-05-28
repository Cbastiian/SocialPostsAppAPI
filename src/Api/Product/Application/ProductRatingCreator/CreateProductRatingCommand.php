<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\ProductRatingCreator;

use Src\Api\Shared\Domain\Contracts\Command;

final class CreateProductRatingCommand implements Command
{
    private string $value;
    private int $productId;
    private int $userId;
    private ?string $userComment;

    public function __construct(
        string $value,
        int $productId,
        int $userId,
        ?string $userComment
    ) {
        $this->value = $value;
        $this->productId = $productId;
        $this->userId = $userId;
        $this->userComment = $userComment;
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
        return $this->userComment;
    }
}
