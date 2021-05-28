<?php

declare(strict_types=1);

namespace App\Dto\Products;

use Spatie\DataTransferObject\DataTransferObject;

final class CreateProductRatingData extends DataTransferObject
{
    public string $value;
    public int $userId;
    public int $productId;
    public ?string $comment;
}
