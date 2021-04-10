<?php

declare(strict_types=1);

namespace App\Dto\User;

use Illuminate\Http\UploadedFile;
use Spatie\DataTransferObject\DataTransferObject;

final class UpdateUserProfilePhotoData extends DataTransferObject
{
    public UploadedFile $photo;
}
