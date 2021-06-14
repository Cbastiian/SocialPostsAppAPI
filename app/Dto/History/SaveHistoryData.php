<?php

declare(strict_types=1);

namespace App\Dto\History;

use Illuminate\Http\UploadedFile;
use Spatie\DataTransferObject\DataTransferObject;

final class SaveHistoryData extends DataTransferObject
{
    public ?string $comment;
    public int $userId;
    public UploadedFile $file;
}
