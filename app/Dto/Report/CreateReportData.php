<?php

declare(strict_types=1);

namespace App\Dto\Report;

use Spatie\DataTransferObject\DataTransferObject;

final class CreateReportData extends DataTransferObject
{
    public int $reasonId;
    public string $reportElementType;
    public int $reportElementId;
    public int $reportUserId;
}
