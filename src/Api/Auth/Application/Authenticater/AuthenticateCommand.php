<?php

declare(strict_types=1);

namespace Src\Api\Auth\Application\Authenticater;

use Src\Api\Shared\Domain\Contracts\Command;

final class AuthenticateCommand implements Command
{
    private string $username;
    private string $password;

    public  function __construct(
        string $username,
        string $password
    ) {
        $this->username = $username;
        $this->password = $password;
    }

    /***
     * get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /***
     * get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }
}
