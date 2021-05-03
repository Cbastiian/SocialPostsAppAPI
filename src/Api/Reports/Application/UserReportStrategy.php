<?php

namespace Src\Api\Reports\Application;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\User\Domain\Contracts\UserValidation;
use Src\Api\Reports\Domain\ValueObjects\ReportElementId;
use Src\Api\Reports\Domain\Contracts\ReportElementStrategy;

final class UserReportStrategy implements ReportElementStrategy
{
    private UserValidation $userValidation;

    public function __construct(UserValidation $userValidation)
    {
        $this->userValidation = $userValidation;
    }

    public function executeElementValidtion(ReportElementId $reportElementId)
    {
        $userId = new UserId($reportElementId->value());

        $this->userValidation->throwIfUserNotExist($userId);
    }
}
