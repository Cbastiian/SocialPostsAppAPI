<?php

declare(strict_types=1);

namespace Src\Api\Comment\Application\CommentCreator;

use Src\Api\Post\Domain\ValueObjects\PostId;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Post\Domain\ValueObjects\Content;
use Src\Api\Post\Domain\Contracts\PostValidation;
use Src\Api\User\Domain\Contracts\UserValidation;
use Src\Api\Shared\Domain\Contracts\CommandHandler;

final class CreateCommentHandler implements CommandHandler
{
    private CommentCreator $commentCreator;
    private PostValidation $postValidation;
    private UserValidation $userValidation;

    public function __construct(
        CommentCreator $commentCreator,
        PostValidation $postValidation,
        UserValidation $userValidation
    ) {
        $this->commentCreator = $commentCreator;
        $this->postValidation = $postValidation;
        $this->userValidation = $userValidation;
    }

    public function execute($command)
    {
        $content = new Content($command->getContent());
        $postId = new PostId($command->getPostId());
        $commentatorUserId = new UserId($command->getCommentatorUserId());

        $this->postValidation->throwIfPostIdNotExistError($postId);
        $this->userValidation->throwIfUserNotExist($commentatorUserId);

        return $this->commentCreator->__invoke($content, $postId, $commentatorUserId);
    }
}
