<?php

declare(strict_types=1);

namespace App\Dto\Post;

use Spatie\DataTransferObject\DataTransferObject;

final class ChangePostStatusData extends DataTransferObject
{
    public int $postId;
    public bool $status;
}
