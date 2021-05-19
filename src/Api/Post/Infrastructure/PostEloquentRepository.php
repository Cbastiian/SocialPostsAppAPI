<?php

namespace Src\Api\Post\Infrastructure;

use App\Models\Post;
use Src\Api\Post\Domain\PostEntity;
use Src\Api\Post\Domain\ValueObjects\PostId;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Shared\Domain\ValueObjects\Status;
use Src\Api\Post\Domain\Contracts\PostRepository;

final class PostEloquentRepository implements PostRepository
{
    public function savePost(PostEntity $postEntity)
    {
        return Post::create($postEntity->toArray());
    }

    public function getPosts(UserId $userId)
    {
        return Post::where([
            ['user_id', $userId],
            ['active', 1]
        ])
            ->get();
    }

    public function getReportedPost()
    {
        return Post::join('reports', 'reports.report_element_id', 'post.id')
            ->join('report_reasons', 'report_reasons.id', '=', 'reports.reason_id')
            ->join('users as report_user', 'report_user.id', '=', 'reports.report_user_id')
            ->join('users as post_user', 'post_user.id', '=', 'user_id')
            ->select(
                'post.content',
                'reports.created_at as report_date',
                'report_reasons.name as reason_name',
                'report_user.name as reporting_user',
                'post_user.name as post_owner_name'
            )
            ->where('reports.report_element_type', 'POST')
            ->get();
    }

    public function changePostStatus(PostId $postId, Status $status)
    {
        Post::where('id', $postId->value())
            ->first()
            ->update([
                'active' => intval($status->value())
            ]);
    }

    public function findById(PostId $postId)
    {
        return Post::where('id', $postId)->first();
    }
}
