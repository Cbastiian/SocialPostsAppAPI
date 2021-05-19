<?php

declare(strict_types=1);

namespace Src\Api\Comment\Infrastructure;

use App\Models\Comment;
use Src\Api\Comment\Domain\CommentEntity;
use Src\Api\Post\Domain\ValueObjects\PostId;
use Src\Api\Shared\Domain\ValueObjects\Status;
use Src\Api\Comment\Domain\ValueObjects\CommentId;
use Src\Api\Comment\Domain\Contracts\CommentRepository;

final class CommentEloquentRepository implements CommentRepository
{
    public function saveComment(CommentEntity $commentEntity)
    {
        return Comment::create($commentEntity->toArray());
    }

    public function getPostComments(PostId $postId)
    {
        return Comment::where([
            ['post_id', $postId->value()],
            ['active', 1]
        ])->get();
    }

    public function getReportedComments()
    {
        return Comment::join('reports', 'reports.report_element_id', 'comments.id')
            ->join('report_reasons', 'report_reasons.id', '=', 'reports.reason_id')
            ->join('users as report_user', 'report_user.id', '=', 'reports.report_user_id')
            ->join('users as comentator_user', 'comentator_user.id', '=', 'comentator_user_id')
            ->select(
                'comments.content',
                'reports.created_at as report_date',
                'report_reasons.name as reason_name',
                'report_user.name as reporting_user',
                'comentator_user.name as comentator_user_name'
            )
            ->where('reports.report_element_type', 'COMMENT')
            ->get();
    }

    public function changeCommentStatus(CommentId $commentId, Status $status)
    {
        Comment::where('id', $commentId->value())
            ->first()
            ->update([
                'active' => intval($status->value())
            ]);
    }
}
