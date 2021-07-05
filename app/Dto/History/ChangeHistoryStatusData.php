<?php

declare(strict_types=1);

namespace App\Dto\History;

use Spatie\DataTransferObject\DataTransferObject;

final class ChangeHistoryStatusData extends DataTransferObject
{
    public int $historyId;
    public int $userId;
    public bool $status;
}
