<?php

namespace Src\Api\Reports\Application;

use phpDocumentor\Reflection\Types\This;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Shared\Domain\ValueObjects\Status;
use Src\Api\User\Application\ListReportedUsers;
use Src\Api\User\Domain\Contracts\UserRepository;
use Src\Api\User\Domain\Contracts\UserValidation;
use Src\Api\Reports\Domain\ValueObjects\ReportElementId;
use Src\Api\Reports\Domain\Contracts\ReportElementStrategy;

final class UserReportStrategy implements ReportElementStrategy
{
    private ?UserValidation $userValidation;
    private ?ListReportedUsers $listReportedUsers;
    private ?UserRepository $userRepository;

    public function __construct(
        ?UserValidation $userValidation,
        ?ListReportedUsers $listReportedUsers,
        ?UserRepository $userRepository
    ) {
        $this->userValidation = $userValidation;
        $this->listReportedUsers = $listReportedUsers;
        $this->userRepository = $userRepository;
    }

    public function executeElementValidtion(ReportElementId $reportElementId)
    {
        $userId = new UserId($reportElementId->value());

        $this->userValidation->throwIfUserNotExist($userId);
        $this->userValidation->throwIfUserIsAdmin($userId);
    }

    public function executeElementGetter()
    {
        return $this->listReportedUsers->__invoke();
    }

    public function executeElementPunish(ReportElementId $reportElementId)
    {
        $userId = new UserId($reportElementId->value());
        $status = new Status(false);

        $this->userRepository->changeUserStatus($userId, $status);
    }
}
