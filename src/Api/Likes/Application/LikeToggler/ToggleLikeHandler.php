<?php

declare(strict_types=1);

namespace Src\Api\Likes\Application\LikeToggler;

use Src\Api\Post\Domain\ValueObjects\PostId;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Post\Domain\Contracts\PostRepository;
use Src\Api\Post\Domain\Contracts\PostValidation;
use Src\Api\User\Domain\Contracts\UserRepository;
use Src\Api\User\Domain\Contracts\UserValidation;
use Src\Api\Shared\Domain\Contracts\CommandHandler;

final class ToggleLikeHandler implements CommandHandler
{
    private LikeToggler $likeToggler;
    private UserRepository $userRepository;
    private PostRepository $postRepository;
    private UserValidation $userValidation;
    private PostValidation $postValidation;

    public function __construct(
        LikeToggler $likeToggler,
        UserRepository $userRepository,
        PostRepository $postRepository,
        UserValidation $userValidation,
        PostValidation $postValidation
    ) {
        $this->likeToggler = $likeToggler;
        $this->userRepository = $userRepository;
        $this->postRepository = $postRepository;
        $this->userValidation = $userValidation;
        $this->postValidation = $postValidation;
    }

    public function execute($command)
    {
        $userId = new UserId($command->getUserId());
        $postId = new PostId($command->getPostId());

        $this->userValidation->throwIfUserNotExist($userId);
        $this->postValidation->throwIfPostIdNotExistError($postId);

        $user = $this->userRepository->findById($userId);
        $post = $this->postRepository->findById($postId);

        return $this->likeToggler->__invoke($user, $post);
    }
}
