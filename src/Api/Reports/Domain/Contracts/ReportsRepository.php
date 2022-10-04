<?php

namespace Src\Api\Reports\Domain\Contracts;

use Src\Api\Reports\Domain\ReportEntity;
use Src\Api\Reports\Domain\ValueObjects\ReasonId;
use Src\Api\Reports\Domain\ValueObjects\ReportId;
use Src\Api\Reports\Domain\ReportPunishManagementEntity;
use Src\Api\Reports\Domain\ValueObjects\ReportElementId;
use Src\Api\Reports\Domain\ValueObjects\ReportElementType;

interface ReportsRepository
{
    public function createReport(ReportEntity $reportEntity);
    public function getReportReasonData(ReasonId $reasonId);
    public function findReportId(ReportId $reportId);
    public function punishReport(ReportPunishManagementEntity $reportPunishManagementEntity);
    public function getReportsByReaasonNumber(ReportElementId $reportElementId, ReportElementType $reportElementType, ReasonId $reasonId);
}
