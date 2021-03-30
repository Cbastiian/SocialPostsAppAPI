<?php

declare(strict_types=1);

namespace Src\Api\User\Application\UserEmailValidator;

use Src\Api\Shared\Domain\Contracts\Command;

final class UserEmailValidationCommand implements Command
{
    private string $email;
    private string $otpCode;

    public function __construct(
        string $email,
        string $otpCode
    ) {
        $this->email = $email;
        $this->otpCode = $otpCode;
    }

    /***
     * get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /***
     * get the value of otpCode
     */
    public function getOtpCode()
    {
        return $this->otpCode;
    }
}
