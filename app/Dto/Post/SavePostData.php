<?php

declare(stric_types=1);

namespace App\Dto\Post;

use Illuminate\Http\UploadedFile;
use Spatie\DataTransferObject\DataTransferObject;

final class SavePostData extends DataTransferObject
{
    public string $content;
    public ?UploadedFile $file;
    public int $userId;
}