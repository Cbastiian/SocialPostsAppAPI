<?php

declare(strict_types=1);

namespace App\Dto\Products;

use Spatie\DataTransferObject\DataTransferObject;

final class CreateFavoriteData extends DataTransferObject
{
    public int $productId;
    public int $userId;
}
