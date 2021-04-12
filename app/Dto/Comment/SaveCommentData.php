<?php

declare(strict_types=1);

namespace App\Dto\Comment;

use Spatie\DataTransferObject\DataTransferObject;

final class SaveCommentData extends DataTransferObject
{
    public string $content;
    public int $postId;
    public int $commentatorUserId;
}
