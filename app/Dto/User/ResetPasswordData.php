<?php

declare(strict_types=1);

namespace App\Dto\User;

use Spatie\DataTransferObject\DataTransferObject;

final class ResetPasswordData extends DataTransferObject
{
    public string $token;
    public string $password;
}
