<?php

declare(strict_types=1);

namespace App\Dto\Products;

use Spatie\DataTransferObject\DataTransferObject;

final class ChangeProductStatusData extends DataTransferObject
{
    public int $productId;
    public bool $status;
    public int $userId;
}
