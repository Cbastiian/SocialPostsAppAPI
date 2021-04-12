<?php

declare(strict_types=1);

namespace Src\Api\Comment\Infrastructure;

use App\Models\Comment;
use Src\Api\Comment\Domain\CommentEntity;
use Src\Api\Comment\Domain\Contracts\CommentRepository;

final class CommentEloquentRepository implements CommentRepository
{
    public function saveComment(CommentEntity $commentEntity)
    {
        return Comment::create($commentEntity->toArray());
    }
}
