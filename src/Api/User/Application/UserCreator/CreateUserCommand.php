<?php

declare(strict_types=1);

namespace Src\Api\User\Application\UserCreator;

use Illuminate\Http\UploadedFile;
use Src\Api\Shared\Domain\Contracts\Command;

final class CreateUserCommand implements Command
{
    private string $name;
    private string $email;
    private string $username;
    private string $password;
    private ?UploadedFile $photo;

    public function __construct(
        string $name,
        string $email,
        string $username,
        string $password,
        ?UploadedFile $photo
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->photo = $photo;
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

    /***
     * get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /***
     * get the value of photo
     */
    public function getPhoto()
    {
        return $this->photo;
    }
}
