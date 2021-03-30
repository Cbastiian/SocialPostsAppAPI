<?php

declare(strict_types=1);

namespace App\Dto\User;

use Spatie\DataTransferObject\DataTransferObject;

final class ResendVerificationEmailData extends DataTransferObject
{
    public string $email;
}
