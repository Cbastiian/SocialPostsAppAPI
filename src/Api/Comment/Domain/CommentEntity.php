<?php

declare(strict_types=1);

namespace Src\Api\Comment\Domain;

use Src\Api\Post\Domain\ValueObjects\PostId;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Post\Domain\ValueObjects\Content;
use Src\Api\Comment\Domain\ValueObjects\CommentatorUserId;

final class CommentEntity
{
    private Content $content;
    private PostId $postId;
    private UserId $commentatorUserId;

    public function __construct(
        Content $content,
        PostId $postId,
        UserId $commentatorUserId
    ) {
        $this->content = $content;
        $this->postId = $postId;
        $this->commentatorUserId = $commentatorUserId;
    }

    public static function create(
        Content $content,
        PostId $postId,
        UserId $commentatorUserId
    ) {
        return new self(
            $content,
            $postId,
            $commentatorUserId
        );
    }

    /***
     * get the value of contet
     */
    public function getContent(): Content
    {
        return $this->content;
    }

    /***
     * get the value postIs
     */
    public function getPostId(): PostId
    {
        return $this->postId;
    }

    /***
     * get the value of commentatorUserId
     */
    public function getCommentatorUserId(): UserId
    {
        return $this->commentatorUserId;
    }

    public function toArray(): array
    {
        return [
            'content' => $this->getContent()->value(),
            'post_id' => $this->getPostId()->value(),
            'comentator_user_id' => $this->getCommentatorUserId()->value()
        ];
    }
}
