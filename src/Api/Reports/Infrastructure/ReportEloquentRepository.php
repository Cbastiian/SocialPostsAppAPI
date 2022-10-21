<?php

namespace Src\Api\Reports\Infrastructure;

use App\Models\Report;
use App\Models\ReportReasons;
use App\Models\ReportPunishManagement;
use Src\Api\Reports\Domain\ReportEntity;
use Src\Api\Reports\Domain\ValueObjects\ReasonId;
use Src\Api\Reports\Domain\ValueObjects\ReportId;
use Src\Api\Reports\Domain\Contracts\ReportsRepository;
use Src\Api\Reports\Domain\ReportPunishManagementEntity;
use Src\Api\Reports\Domain\ValueObjects\ReportElementId;
use Src\Api\Reports\Domain\ValueObjects\ReportElementType;

final class ReportEloquentRepository implements ReportsRepository
{
    public function createReport(ReportEntity $reportEntity)
    {
        return Report::create($reportEntity->toArray());
    }

    public function getReportReasonData(ReasonId $reasonId)
    {
        return ReportReasons::where('id', $reasonId->value())->first();
    }

    public function findReportId(ReportId $reportId)
    {
        return Report::where('id', $reportId->value())->first();
    }

    public function punishReport(ReportPunishManagementEntity $reportPunishManagementEntity)
    {
        return ReportPunishManagement::create($reportPunishManagementEntity->toArray());
    }

    public function getReportsByReaasonNumber(
        ReportElementId $reportElementId,
        ReportElementType $reportElementType,
        ReasonId $reasonId
    ) {
        return Report::where([
            ['reason_id', $reasonId->value()],
            ['report_element_type', $reportElementType->value()],
            ['report_element_id', $reportElementId->value()]
        ])->count();
    }
}
