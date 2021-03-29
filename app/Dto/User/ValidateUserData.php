<?php

declare(strict_types=1);

namespace App\Dto\User;

use Spatie\DataTransferObject\DataTransferObject;

final class ValidateUserData extends DataTransferObject
{
    public string $email;
    public string $otpCode;
}
