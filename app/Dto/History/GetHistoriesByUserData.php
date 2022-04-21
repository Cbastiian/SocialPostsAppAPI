<?php

declare(strict_types=1);

namespace App\Dto\History;

use Spatie\DataTransferObject\DataTransferObject;

final class GetHistoriesByUserData extends DataTransferObject
{
    public int $userId;
}
