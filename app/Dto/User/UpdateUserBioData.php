<?php

declare(strict_types=1);

namespace App\Dto\User;

use Spatie\DataTransferObject\DataTransferObject;

final class UpdateUserBioData extends DataTransferObject
{
    public int $userId;
    public string $bio;
}
