<?php

declare(strict_types=1);

namespace App\Dto\Like;

use Spatie\DataTransferObject\DataTransferObject;

final class ToggleLikeData extends DataTransferObject
{
    public int $userId;
    public int $postId;
}
