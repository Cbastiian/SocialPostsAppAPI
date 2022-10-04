<?php

declare(strict_types=1);

namespace App\Dto\User;

use Spatie\DataTransferObject\DataTransferObject;

final class UpdateUserData extends DataTransferObject
{
    public int $userId;
    public string $email;
    public string $name;
    public string $username;
}
