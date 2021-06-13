<?php

declare(strict_types=1);

namespace App\Dto\Products;

use Spatie\DataTransferObject\DataTransferObject;

final class GetGeneralProductsDate extends DataTransferObject
{
    public ?int $limit;
    public int $page;
}
