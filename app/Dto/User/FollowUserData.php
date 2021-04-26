<?php

declare(strict_types=1);

namespace App\Dto\User;

use Spatie\DataTransferObject\DataTransferObject;

final class FollowUserData extends DataTransferObject
{
    public int $followingUserId;
}
