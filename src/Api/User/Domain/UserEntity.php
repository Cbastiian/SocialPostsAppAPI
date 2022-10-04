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

    public function toCreateArray(): array
    {
        return [
            'name' => $this->getName()->value(),
            'email' => $this->getEmail()->value(),
            'username' => $this->getUsername()->value(),
            'password' => $this->getPassword()->value(),
            'photo' => $this->getPhoto()->value()
        ];
    }

    public function toUpdateArray(): array
    {
        return [
            'name' => $this->getName()->value(),
            'email' => $this->getEmail()->value(),
            'username' => $this->getUsername()->value(),
        ];
    }

    /***
     * get the value of name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /***
     * set the value of name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /***
     * get the value of email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /***
     * set the value of email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /***
     * get the value of username
     */
    public function getUsername(): Username
    {
        return $this->username;
    }

    /***
     * set the value of username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /***
     * get the value of password
     */
    public function getPassword(): Password
    {
        return $this->password;
    }

    /***
     * set the value of password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /***
     * get the value of photo
     */
    public function getPhoto(): Photo
    {
        return $this->photo;
    }

    /***
     * set the value of photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }
}
