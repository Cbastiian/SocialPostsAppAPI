<?php

declare(strict_types=1);

namespace Src\Api\User\Application\ProfilePhotoUpdater;

use Src\Api\User\Domain\ValueObjects\Photo;
use Src\Api\Shared\Application\Images\ImageCreator;
use Src\Api\Shared\Domain\Contracts\CommandHandler;

final class UpdateProfilePhotoHandler implements CommandHandler
{
    private ProfilePhotoUpdater $profilePhotoUpdater;
    private ImageCreator $imageCreator;

    public function __construct(
        ProfilePhotoUpdater $profilePhotoUpdater,
        ImageCreator $imageCreator)
    {
        $this->profilePhotoUpdater = $profilePhotoUpdater;
        $this->imageCreator = $imageCreator;
    }

    public function execute($command)
    {
        $userPhoto = $this->imageCreator->__invoke($command->getPhoto(), 'img/profile/');
        
        $photo = new Photo($userPhoto->imageName);
        
        $this->profilePhotoUpdater->__invoke($photo);
    }
}
