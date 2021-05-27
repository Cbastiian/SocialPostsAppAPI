<?php

declare(strict_types=1);

namespace App\Dto\Products;

use Spatie\DataTransferObject\DataTransferObject;

final class UpdateProductRatingData extends DataTransferObject
{
    public string $value;
    public int $productId;
    public int $userId;
    public ?string $comment;
}
