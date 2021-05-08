<?php

declare(strict_types=1);

namespace Src\Api\Reports\Application\ReportPunisher;

use Src\Api\Reports\Domain\ValueObjects\ReportId;
use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\Reports\Domain\Contracts\ReportValidation;

final class PunishReportHandler implements CommandHandler
{
    private ReportValidation $reportValidation;

    public function __construct(ReportValidation $reportValidation)
    {
        $this->reportValidation = $reportValidation;
    }

    public function execute($command)
    {
        $reportId = new ReportId($command->getReportId());

        $this->reportValidation->throwIfReportNotExist($reportId);
    }
}
