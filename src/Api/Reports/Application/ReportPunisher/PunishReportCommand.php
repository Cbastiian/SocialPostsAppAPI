<?php

declare(strict_types=1);

namespace Src\Api\Reports\Application\ReportPunisher;

use Src\Api\Shared\Domain\Contracts\Command;

final class PunishReportCommand implements Command
{
    private int $reportId;

    public function __construct(int $reportId)
    {
        $this->reportId = $reportId;
    }

    /***
     * get the value of reportId
     */
    public function getReportId()
    {
        return $this->reportId;
    }
}
