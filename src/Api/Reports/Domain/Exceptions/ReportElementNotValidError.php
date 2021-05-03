<?php

namespace Src\Api\Reports\Domain\Exceptions;

use Src\Api\Shared\Domain\Exceptions\DomainError;
use Src\Api\Reports\Domain\ValueObjects\ReportElementType;

final class ReportElementNotValidError extends  DomainError
{
    private ReportElementType $reportElementType;

    public function __construct(ReportElementType $reportElementType)
    {
        $this->reportElementType = $reportElementType;
    }

    public function errorCode(): string
    {
        return 'REPORT_ELEMENT_TYPE_NOT_VALID';
    }

    public function errorMessage(): string
    {
        return 'The report element type ' . $this->reportElementType->value() . ' is not valid (Avliable types: POST,COMMENT,USER,PRODUCT)';
    }
}
