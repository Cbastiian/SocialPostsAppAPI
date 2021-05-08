<?php

namespace Src\Api\Reports\Domain\Exceptions;

use Src\Api\Reports\Domain\ValueObjects\ReportId;
use Src\Api\Shared\Domain\Exceptions\DomainError;

final class ReportNotExistError extends DomainError
{
    private ReportId $reportId;

    public function __construct(ReportId $reportId)
    {
        $this->reportId = $reportId;
    }

    public function errorCode(): string
    {
        return 'REPORT_NOT_EXIST';
    }

    public function errorMessage(): string
    {
        return 'The report with id ' . $this->reportId->value() . ' not exist';
    }
}
