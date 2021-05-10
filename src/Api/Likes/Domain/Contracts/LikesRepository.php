<?php

namespace Src\Api\Likes\Domain\Contracts;

interface LikesRepository
{
    public function toggleLike($user, $post);
    public function getPostLikers($post);
    public function getPostLikedByUser($post);
}
