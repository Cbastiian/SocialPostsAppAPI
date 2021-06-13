<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\ProductStatusChanger;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Shared\Domain\ValueObjects\Status;
use Src\Api\Product\Domain\ValueObjects\ProductId;
use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\Product\Domain\Contracts\ProductValidation;

final class ChangeProductStatusHandler implements CommandHandler
{
    private ProductStatusChanger $productStatusChanger;
    private ProductValidation $productValidation;

    public function __construct(
        ProductStatusChanger $productStatusChanger,
        ProductValidation $productValidation
    ) {
        $this->productStatusChanger = $productStatusChanger;
        $this->productValidation = $productValidation;
    }

    public function execute($command)
    {
        $productId = new ProductId($command->getProductId());
        $status = new Status($command->getStatus());
        $userId = new UserId($command->getUserId());

        $this->productValidation->throwIfProductIdNotExist($productId);
        $this->productValidation->throwIfNotProductOwner($productId, $userId);

        $this->productStatusChanger->__invoke($productId, $status);
    }
}
