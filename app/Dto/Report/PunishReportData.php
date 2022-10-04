<?php

declare(strict_types=1);

namespace App\Dto\Report;

use Spatie\DataTransferObject\DataTransferObject;

final class PunishReportData extends DataTransferObject
{
    public int $reportId;
    public string $message;
    public bool $isPunished;
}
