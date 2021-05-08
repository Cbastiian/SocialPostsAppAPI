<?php

namespace Src\Api\Reports\Application;

use phpDocumentor\Reflection\Types\This;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\User\Application\ListReportedUsers;
use Src\Api\User\Domain\Contracts\UserValidation;
use Src\Api\Reports\Domain\ValueObjects\ReportElementId;
use Src\Api\Reports\Domain\Contracts\ReportElementStrategy;

final class UserReportStrategy implements ReportElementStrategy
{
    private UserValidation $userValidation;
    private ListReportedUsers $listReportedUsers;

    public function __construct(
        $userValidation = null,
        $listReportedUsers = null
    ) {
        $this->userValidation = $userValidation;
        $this->listReportedUsers = $listReportedUsers;
    }

    public function executeElementValidtion(ReportElementId $reportElementId)
    {
        $userId = new UserId($reportElementId->value());

        $this->userValidation->throwIfUserNotExist($userId);
    }

    public function executeElementGetter()
    {
        return $this->listReportedUsers->__invoke();
    }
}
