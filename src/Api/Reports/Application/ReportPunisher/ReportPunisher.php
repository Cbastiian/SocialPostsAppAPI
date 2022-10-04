<?php

declare(strict_types=1);

namespace Src\Api\Reports\Application\ReportPunisher;

use Src\Api\Reports\Domain\ValueObjects\ReportId;
use Src\Api\Reports\Domain\Contracts\ReportsRepository;
use Src\Api\Reports\Domain\ReportPunishManagementEntity;
use Src\Api\Reports\Domain\ValueObjects\ReportPunishMessage as Message;
use Src\Api\Reports\Domain\ValueObjects\ReportPunishIsPunished as IsPunished;
use Src\Api\Reports\Domain\ValueObjects\ReportPunishIsAutoPunished as IsAutoPunished;

final class ReportPunisher
{
    private ReportsRepository $reportsRepository;

    public function __construct(ReportsRepository $reportsRepository)
    {
        $this->reportsRepository = $reportsRepository;
    }

    public function __invoke(
        ReportId $reportId,
        Message $message,
        IsPunished $isPunished,
        IsAutoPunished $isAutoPunished
    ) {
        $punish = ReportPunishManagementEntity::create($reportId, $message, $isPunished, $isAutoPunished);

        return $this->reportsRepository->punishReport($punish);
    }
}
