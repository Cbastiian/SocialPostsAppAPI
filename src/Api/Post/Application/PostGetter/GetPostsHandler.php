<?php

declare(strict_types=1);

namespace Src\Api\Post\Application\PostGetter;

use Src\Api\Post\Domain\ValueObjects\PostId;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\User\Domain\Contracts\UserRepository;
use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\Likes\Application\LikesGetter\LikesGetter;
use Src\Api\Comment\Application\CommentsGetter\CommentsGetter;
use Src\Api\Likes\Application\LikesGetter\LikedByUserPostGetter;

final  class GetPostsHandler implements CommandHandler
{
    private PostGetter $postGetter;
    private CommentsGetter $commnetsGetter;
    private UserRepository $userRepository;
    private LikesGetter $likesGetter;
    private LikedByUserPostGetter $likedByUserPostGetter;

    public function __construct(
        PostGetter $postGetter,
        CommentsGetter $commnetsGetter,
        UserRepository $userRepository,
        LikesGetter $likesGetter,
        LikedByUserPostGetter $likedByUserPostGetter
    ) {
        $this->postGetter = $postGetter;
        $this->commnetsGetter = $commnetsGetter;
        $this->userRepository = $userRepository;
        $this->likesGetter = $likesGetter;
        $this->likedByUserPostGetter = $likedByUserPostGetter;
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
            $post->likes = $this->likesGetter->__invoke($post);
            $post->userLike = $this->likedByUserPostGetter->__invoke($post);
        }

        return $posts;
    }
}
