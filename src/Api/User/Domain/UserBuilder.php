<?php

namespace Src\Api\User\Domain;

use Src\Api\User\Domain\UserEntity;
use Src\Api\User\Domain\ValueObjects\Name;
use Src\Api\User\Domain\ValueObjects\Email;
use Src\Api\User\Domain\ValueObjects\Photo;
use Src\Api\User\Domain\ValueObjects\Password;
use Src\Api\User\Domain\ValueObjects\Username;
use Src\Api\User\Domain\Contracts\UserBuilderInterface;

final class UserBuilder implements UserBuilderInterface
{
    private UserEntity $userEntity;

    private Name $name;
    private Email $email;
    private Username $username;
    private Password $password;
    private ?Photo $photo;

    public function __construct()
    {
        $this->userEntity = new UserEntity();
    }

    public function buildCreateUser(): UserEntity
    {
        $this->userEntity->setName($this->name);
        $this->userEntity->setEmail($this->email);
        $this->userEntity->setUsername($this->username);
        $this->userEntity->setPassword($this->password);
        $this->userEntity->setPhoto($this->photo);

        return $this->userEntity;
    }

    public function buildUpdateUser(): UserEntity
    {
        $this->userEntity->setName($this->name);
        $this->userEntity->setEmail($this->email);
        $this->userEntity->setUsername($this->username);

        return $this->userEntity;
    }

    /***
     * with the value of name;
     */
    public function withName(Name $name)
    {
        $this->name = $name;

        return $this;
    }

    /***
     * with the value of email;
     */
    public function withEmail(Email $email)
    {
        $this->email = $email;

        return $this;
    }

    /***
     * with the value of username;
     */
    public function withUsername(Username $username)
    {
        $this->username = $username;

        return $this;
    }

    /***
     * with the value of password;
     */
    public function withPassword(Password $password)
    {
        $this->password = $password;

        return $this;
    }

    /***
     * with the value of photo;
     */
    public function withPhoto(Photo $photo)
    {
        $this->photo = $photo;

        return $this;
    }
}
