<?php

namespace Src\Api\Comment\Domain\Contracts;

use Src\Api\Comment\Domain\CommentEntity;

interface CommentRepository
{
    public function saveComment(CommentEntity $commentEntity);
}
