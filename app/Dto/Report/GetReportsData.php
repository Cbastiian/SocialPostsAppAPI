<?php

declare(strict_types=1);

namespace App\Dto\Report;

use Spatie\DataTransferObject\DataTransferObject;

final class GetReportsData extends DataTransferObject
{
    public string $reportElementType;
}
