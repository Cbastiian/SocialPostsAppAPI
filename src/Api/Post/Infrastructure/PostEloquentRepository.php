<?php

namespace Src\Api\Post\Infrastructure;

use App\Models\Post;
use Src\Api\Post\Domain\PostEntity;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Post\Domain\Contracts\PostRepository;

final class PostEloquentRepository implements PostRepository
{
    public function savePost(PostEntity $postEntity)
    {
        return Post::create($postEntity->toArray());
    }

    public function getPosts(UserId $userId)
    {
        return Post::where('user_id', $userId)->get();
    }

    public function getReportedPost()
    {
        return Post::join('reports', 'reports.reported_element_id', 'post.id')
            ->where('reports.report_element_type', 'POST')
            ->get();
    }
}
