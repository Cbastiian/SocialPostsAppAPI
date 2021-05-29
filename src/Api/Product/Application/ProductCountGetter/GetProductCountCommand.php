<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\ProductCountGetter;

use Src\Api\Shared\Domain\Contracts\Command;

final class GetProductCountCommand implements Command
{
    private int $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    /***
     * ge the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
