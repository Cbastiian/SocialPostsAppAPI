<?php

declare(strict_types=1);

namespace Src\Api\Reports\Application\ReportGetter;

use Src\Api\Shared\Domain\Contracts\Command;

final class GetReportsCommand implements Command
{
    private string $reportElementType;

    public function __construct(string $reportElementType)
    {
        $this->reportElementType = $reportElementType;
    }

    /***
     * get the value of reportElementType
     */
    public function getReportElementType()
    {
        return $this->reportElementType;
    }
}
