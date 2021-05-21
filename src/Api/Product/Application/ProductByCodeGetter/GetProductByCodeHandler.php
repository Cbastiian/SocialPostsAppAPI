<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\ProductByCodeGetter;

use phpDocumentor\Reflection\Types\This;
use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\Product\Domain\ValueObjects\ProductCode;
use Src\Api\Product\Domain\Contracts\ProductValidation;

final class GetProductByCodeHandler implements CommandHandler
{
    private ProductByCodeGetter $productByCodeGetter;
    private ProductValidation $productValidation;

    public function __construct(
        ProductByCodeGetter $productByCodeGetter,
        ProductValidation $productValidation
    ) {
        $this->productByCodeGetter = $productByCodeGetter;
        $this->productValidation = $productValidation;
    }

    public function execute($command)
    {
        $productCode = new ProductCode($command->getProductCode());

        $this->productValidation->throwIfProductCodeNotExist($productCode);

        return $this->productByCodeGetter->__invoke($productCode);
    }
}
