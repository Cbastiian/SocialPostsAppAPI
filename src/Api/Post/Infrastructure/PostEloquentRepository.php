<?php

namespace Src\Api\Post\Infrastructure;

use App\Models\Post;
use Src\Api\Post\Domain\PostEntity;
use Src\Api\Post\Domain\Contracts\PostRepository;

final class PostEloquentRepository implements PostRepository
{
    public function savePost(PostEntity $postEntity)
    {
        return Post::create($postEntity->toArray());
    }

    public function getPosts()
    {
        return Post::get();
    }
}
