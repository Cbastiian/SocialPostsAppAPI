<?php

declare(strict_types=1);

namespace Src\Api\User\Application\ProfilePhotoUpdater;

use Illuminate\Http\UploadedFile;
use Src\Api\Shared\Domain\Contracts\Command;

final class UpdateProfilePhotoCommand implements Command
{
    private UploadedFile $photo;

    public function __construct(UploadedFile $photo)
    {
        $this->photo = $photo;
    }

    /***
     * get the value of photo
     */
    public function getPhoto()
    {
        return $this->photo;
    }
}