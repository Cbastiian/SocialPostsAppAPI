<?php

namespace Src\Api\Reports\Domain\Contracts;

use Src\Api\Reports\Domain\ReportEntity;

interface ReportsRepository
{
    public function createReport(ReportEntity $reportEntity);
}
