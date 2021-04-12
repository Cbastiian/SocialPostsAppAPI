<?php

declare(strict_types=1);

namespace Src\Api\User\Domain;

use Src\Api\User\Domain\ValueObjects\Name;
use Src\Api\User\Domain\ValueObjects\Email;
use Src\Api\User\Domain\ValueObjects\Photo;
use Src\Api\User\Domain\ValueObjects\Password;
use Src\Api\User\Domain\ValueObjects\Username;

final class UserEntity
{
    private Name $name;
    private Email $email;
    private Username $username;
    private Password $password;
    private ?Photo $photo;

    public function __construct(
        Name $name,
        Email $email,
        Username $username,
        Password $password,
        ?Photo $photo
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->photo = $photo;
    }

    public static  function create(
        Name $name,
        Email $email,
        Username $username,
        Password $password,
        ?Photo $photo
    ) {
        return new self(
            $name,
            $email,
            $username,
            $password,
            $photo
        );
    }

    /***
     * get the value of name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /***
     * get the value of email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /***
     * get the value of username
     */
    public function getUsername(): Username
    {
        return $this->username;
    }

    /***
     * get the value of password
     */
    public function getPassword(): Password
    {
        return $this->password;
    }

    /***
     * get the value of photo
     */
    public function getPhoto(): Photo
    {
        return $this->photo;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->getName()->value(),
            'email' => $this->getEmail()->value(),
            'username' => $this->getUsername()->value(),
            'password' => $this->getPassword()->value(),
            'photo' => $this->getPhoto()->value()
        ];
    }
}
