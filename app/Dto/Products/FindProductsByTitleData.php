<?php

declare(strict_types=1);

namespace App\Dto\Products;

use Spatie\DataTransferObject\DataTransferObject;

final class FindProductsByTitleData extends DataTransferObject
{
    public string $title;
    public ?int $limit;
    public int $page;
}
