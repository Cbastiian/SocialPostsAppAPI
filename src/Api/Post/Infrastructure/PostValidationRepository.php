<?php

namespace Src\Api\Post\Infrastructure;

use App\Models\Post;
use Src\Api\Post\Domain\ValueObjects\PostId;
use Src\Api\Post\Domain\Contracts\PostValidation;
use Src\Api\Post\Domain\Exceptions\PostNotExistError;

final class PostValidationRepository implements PostValidation
{
    public function throwIfPostIdNotExistError(PostId $postId)
    {
        $post = $this->findPostId($postId);

        if ($post === null) throw new PostNotExistError($postId);
    }

    public function findPostId(PostId $postId)
    {
        return Post::where('id', $postId->value())->first();
    }
}
