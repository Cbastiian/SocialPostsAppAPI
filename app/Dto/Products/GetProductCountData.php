<?php

declare(strict_types=1);

namespace App\Dto\Products;

use Spatie\DataTransferObject\DataTransferObject;

final class GetProductCountData extends DataTransferObject
{
    public int $userId;
}
