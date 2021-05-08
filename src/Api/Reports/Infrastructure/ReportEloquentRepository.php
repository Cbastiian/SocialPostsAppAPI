<?php

namespace Src\Api\Reports\Infrastructure;

use App\Models\Report;
use Src\Api\Reports\Domain\ReportEntity;
use Src\Api\Reports\Domain\ValueObjects\ReportId;
use Src\Api\Reports\Domain\Contracts\ReportsRepository;

final class ReportEloquentRepository implements ReportsRepository
{
    public function createReport(ReportEntity $reportEntity)
    {
        return Report::create($reportEntity->toArray());
    }

    public function findReportId(ReportId $reportId)
    {
        return Report::where('id', $reportId->value())->first();
    }
}
