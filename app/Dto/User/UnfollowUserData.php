<?php

declare(strict_types=1);

namespace App\Dto\User;

use Spatie\DataTransferObject\DataTransferObject;

final class UnfollowUserData extends DataTransferObject
{
    public int $followingUserId;
}
