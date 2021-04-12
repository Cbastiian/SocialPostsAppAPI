<?php

declare(strict_types=1);

namespace Src\Api\Comment\Application\CommentCreator;

use Src\Api\Shared\Domain\Contracts\Command;

final class CreateCommentCommand implements Command
{
    private string $content;
    private int $postId;
    private int $commentatorUserId;

    public function __construct(
        string $content,
        int $postId,
        int $commentatorUserId
    ) {
        $this->content = $content;
        $this->postId = $postId;
        $this->commentatorUserId = $commentatorUserId;
    }

    /***
     * get the value of content 
     */
    public function getContent()
    {
        return $this->content;
    }
    /***
     * get the value of postId
     */
    public function getPostId()
    {
        return $this->postId;
    }
    /***
     * get the value of commentatorUserId
     */
    public function getCommentatorUserId()
    {
        return $this->commentatorUserId;
    }
}
