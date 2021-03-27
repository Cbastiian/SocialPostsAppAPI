<?php

declare(strict_types=1);

namespace Src\Api\User\Application\UserCreator;

use Src\Api\Shared\Application\Images\ImageCreator;
use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\User\Domain\ValueObjects\Email;
use Src\Api\User\Domain\ValueObjects\Name;
use Src\Api\User\Domain\ValueObjects\Password;
use Src\Api\User\Domain\ValueObjects\Photo;
use Src\Api\User\Domain\ValueObjects\Username;

final class CreateUserHandler implements CommandHandler
{
    private UserCreator $userCreator;
    private ImageCreator $imageCreator;

    public function __construct(
        UserCreator $userCreator,
        ImageCreator $imageCreator
    ) {
        $this->userCreator = $userCreator;
        $this->imageCreator = $imageCreator;
    }

    public function execute($command)
    {
        $name = new Name($command->getName());
        $emai = new Email($command->getEmail());
        $username = new Username($command->getUsername());
        $password = new Password($command->getPassword());

        $userPhoto = $this->imageCreator->__invoke($command->getPhoto(), 'img/profile/');

        $photo = new Photo($userPhoto->imageName);

        return $this->userCreator->__invoke(
            $name,
            $emai,
            $username,
            $password,
            $photo
        );
    }
}
