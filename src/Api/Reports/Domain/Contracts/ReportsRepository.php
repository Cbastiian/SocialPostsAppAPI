<?php

namespace Src\Api\Reports\Domain\Contracts;

use Src\Api\Reports\Domain\ReportEntity;
use Src\Api\Reports\Domain\ValueObjects\ReportId;

interface ReportsRepository
{
    public function createReport(ReportEntity $reportEntity);
    public function findReportId(ReportId $reportId);
}
