<?php

declare(strict_types=1);

namespace App\Dto\Comment;

use Spatie\DataTransferObject\DataTransferObject;

final class ChangeCommentStatusData extends DataTransferObject
{
    public int $commentId;
    public int $userId;
    public bool $status;
}
