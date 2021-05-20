<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\ProductStatusChanger;

use Src\Api\Shared\Domain\Contracts\Command;

final class ChangeProductStatusCommand implements Command
{
    private int $productId;
    private bool $status;
    private int $userId;

    public function __construct(
        int $productId,
        bool $status,
        int $userId
    ) {
        $this->productId = $productId;
        $this->status = $status;
        $this->userId = $userId;
    }

    /***
     * get the value of productId
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /***
     * get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /***
     * get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
