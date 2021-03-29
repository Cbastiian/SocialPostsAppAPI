<?php

declare(strict_types=1);

namespace App\Dto\Auth\Login;

use Spatie\DataTransferObject\DataTransferObject;

final class LoginData extends DataTransferObject
{
    public string $username;
    public string $password;
}
