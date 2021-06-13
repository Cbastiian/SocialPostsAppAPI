<?php

declare(strict_types=1);

namespace App\Dto\Products;

use Spatie\DataTransferObject\DataTransferObject;

final class UpdateProductData extends DataTransferObject
{
    public int $productId;
    public string $title;
    public string $description;
    public string $userComment;
    public string $price;
    public int $userId;
}
