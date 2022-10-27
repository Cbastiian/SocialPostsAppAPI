<?php

namespace Src\Api\Reports\Domain\Exceptions;

use Src\Api\Reports\Domain\ValueObjects\ReasonId;
use Src\Api\Reports\Domain\ValueObjects\ReportElementType;
use Src\Api\Shared\Domain\Exceptions\DomainError;
use Src\Api\User\Domain\ValueObjects\UserId;

final class SameUserReportLimitError extends DomainError
{
    private ReasonId $reasonId;
    private ReportElementType $reportElementType;
    private UserId $userId;

    public function __construct(
        ReasonId $reasonId,
        ReportElementType $reportElementType,
        UserId $userId
    ) {
        $this->reasonId = $reasonId;
        $this->reportElementType = $reportElementType;
        $this->userId = $userId;
    }

    public function errorCode(): string
    {
        return 'SAMR_USER_REPORT_LIMIT';
    }

    public function errorMessage(): string
    {
        return 'The user with id ' . $this->userId->value() . ' has reached the limit of reports for the same ' . $this->reportElementType . ' on the reason: ' . $this->reasonId;
    }
}
