<?php

namespace Src\Api\Likes\Infrstructure;

use Src\Api\Likes\Domain\Contracts\LikesRepository;

final class LikesEloquentRepository implements LikesRepository
{
    public function toggleLike($user, $post)
    {
        return $user->toggleLike($post);
    }

    public function getPostLikers($post)
    {
        $likers = $post->likers()
            ->select(
                'name',
                'username',
                'photo'
            )
            ->get();

        foreach ($likers as $liker) {

            unset($liker['pivot']);
        }

        return $likers;
    }

    public function getPostLikedByUser($post)
    {
        return $post->isLikedBy(auth()->user());
    }
}
