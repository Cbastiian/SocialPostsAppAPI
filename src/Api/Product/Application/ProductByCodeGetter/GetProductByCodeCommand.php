<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\ProductByCodeGetter;

use Src\Api\Shared\Domain\Contracts\Command;

final class GetProductByCodeCommand implements Command
{
    private string $productCode;

    public function __construct(string $productCode)
    {
        $this->productCode = $productCode;
    }

    /***
     * get the value of productCode
     */
    public function getProductCode()
    {
        return $this->productCode;
    }
}
