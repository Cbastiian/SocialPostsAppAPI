<?php

declare(strict_types=1);

namespace Src\Api\User\Application\ResendVerificationEmail;

use Src\Api\Shared\Domain\Contracts\Command;

final  class ResendVerificationEmailCommand implements Command
{
    private string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    /***
     * get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }
}
