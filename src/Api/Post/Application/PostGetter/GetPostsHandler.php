<?php

declare(strict_types=1);

namespace Src\Api\Post\Application\PostGetter;

use Src\Api\Post\Domain\ValueObjects\PostId;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\User\Domain\Contracts\UserRepository;
use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\Comment\Application\CommentsGetter\CommentsGetter;

final  class GetPostsHandler implements CommandHandler
{
    private PostGetter $postGetter;
    private CommentsGetter $commnetsGetter;
    private UserRepository $userRepository;

    public function __construct(
        PostGetter $postGetter,
        CommentsGetter $commnetsGetter,
        UserRepository $userRepository
    ) {
        $this->postGetter = $postGetter;
        $this->commnetsGetter = $commnetsGetter;
        $this->userRepository = $userRepository;
    }

    public function execute($command)
    {
        $posts = array();

        $followings = $this->userRepository->getFollowings();

        foreach ($followings as $user) {
            $userId = new UserId($user->id);
            array_push($posts, ...$this->postGetter->__invoke($userId));
        }

        foreach ($posts as $post) {
            $postId = new PostId($post->id);
            $post->comments = $this->commnetsGetter->__invoke($postId);
        }

        return $posts;
    }
}
