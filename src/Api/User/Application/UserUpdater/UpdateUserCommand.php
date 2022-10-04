<?php

declare(strict_types=1);

namespace Src\Api\User\Application\UserUpdater;

use Src\Api\Shared\Domain\Contracts\Command;

final class UpdateUserCommand implements Command
{
    private int $userId;
    private string $name;
    private string $email;
    private string $username;

    public function __construct(
        int $userId,
        string $name,
        string $email,
        string $username
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->userId = $userId;
        $this->username = $username;
    }

    /***
     * get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /***
     * get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /***
     * get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /***
     * get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }
}
