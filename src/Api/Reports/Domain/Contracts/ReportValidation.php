<?php

namespace Src\Api\Reports\Domain\Contracts;

use Src\Api\Reports\Domain\ValueObjects\ReasonId;
use Src\Api\Reports\Domain\ValueObjects\ReportElementId;
use Src\Api\Reports\Domain\ValueObjects\ReportId;
use Src\Api\Reports\Domain\ValueObjects\ReportElementType;
use Src\Api\User\Domain\ValueObjects\UserId;

interface ReportValidation
{
    public function throwIfReportEntityInvalid(ReportElementType $reportElementType);
    public function throwIfReportNotExist(ReportId $reportId);
    public function throwIfSameUserReporLimit(ReportElementType $reportElementType, ReportElementId $reportElementId, UserId $userId, ReasonId $reasonId);
}
