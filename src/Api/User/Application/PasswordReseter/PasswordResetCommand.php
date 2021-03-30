<?php

declare(strict_types=1);

namespace Src\Api\User\Application\PasswordReseter;

use Src\Api\Shared\Domain\Contracts\Command;

final class PasswordResetCommand implements Command
{
    private string $token;
    private string $password;

    public function __construct(
        string $token,
        string $password
    ) {
        $this->token = $token;
        $this->password = $password;
    }

    /***
     * get the value of token 
     */
    public function getToken()
    {
        return $this->token;
    }

    /***
     * get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }
}
