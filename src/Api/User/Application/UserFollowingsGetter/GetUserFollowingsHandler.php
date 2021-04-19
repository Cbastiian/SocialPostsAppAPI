<?php

declare(strict_types=1);

namespace Src\Api\User\Application\UserFollowingsGetter;

use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\User\Application\UserFollowingsGetter\UserFollowingsGetter;

final class GetUserFollowingsHandler implements CommandHandler
{
    private UserFollowingsGetter $userFollowingsGetter;

    public function __construct(UserFollowingsGetter $userFollowingsGetter)
    {
        $this->userFollowingsGetter = $userFollowingsGetter;
    }

    public function execute($command)
    {
        return $this->userFollowingsGetter->__invoke();
    }
}
