<?php

declare(strict_types=1);

namespace Src\Api\User\Application\ProfilePhotoUpdater;

use Src\Api\User\Domain\ValueObjects\Photo;
use Src\Api\User\Domain\Contracts\UserRepository;

final class ProfilePhotoUpdater
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(Photo $photo)
    {
        $this->userRepository->updateProfilePhoto($photo);
    }
}
