<?php

declare(strict_types=1);

namespace App\Dto\Products;

use Spatie\DataTransferObject\DataTransferObject;

final class GetFavoritePrdoductsData extends DataTransferObject
{
    public int $userId;
    public ?int $limit;
    public int $page;
}
