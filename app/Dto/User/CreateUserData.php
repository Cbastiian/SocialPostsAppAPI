<?php

declare(strict_types=1);

namespace App\Dto\User;

use Illuminate\Http\UploadedFile;
use Spatie\DataTransferObject\DataTransferObject;

final class CreateUserData extends DataTransferObject
{
    public string $name;
    public string $email;
    public string $username;
    public string $password;
    public ?UploadedFile $photo;
}
