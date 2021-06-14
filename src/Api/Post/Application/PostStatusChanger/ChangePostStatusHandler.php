<?php

declare(strict_types=1);

namespace Src\Api\Post\Application\PostStatusChanger;

use Src\Api\Post\Domain\ValueObjects\PostId;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Shared\Domain\ValueObjects\Status;
use Src\Api\Post\Domain\Contracts\PostValidation;
use Src\Api\Shared\Domain\Contracts\CommandHandler;

final class ChangePostStatusHandler implements CommandHandler
{
    private PostStatusChanger $postStatusChanger;
    private PostValidation $postValidation;

    public function __construct(
        PostStatusChanger $postStatusChanger,
        PostValidation $postValidation
    ) {
        $this->postStatusChanger = $postStatusChanger;
        $this->postValidation = $postValidation;
    }

    public function execute($command)
    {
        $postId = new PostId($command->getPostId());
        $userId = new UserId($command->getUserId());
        $status = new Status($command->getStatus());

        $this->postValidation->throwIfPostIdNotExistError($postId);
        $this->postValidation->throwIfNotPostOwner($postId, $userId);

        $this->postStatusChanger->__invoke($postId, $status);
    }
}
