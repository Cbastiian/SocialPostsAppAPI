<?php

declare(strict_types=1);

namespace App\Dto\Products;

use Spatie\DataTransferObject\DataTransferObject;

final class GetProductByCodeData extends DataTransferObject
{
    public string $productCode;
}
