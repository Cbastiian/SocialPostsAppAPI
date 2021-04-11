<?php

namespace Src\Api\Post\Domain\Contracts;

use Src\Api\Post\Domain\PostEntity;

interface PostRepository
{
    public function savePost(PostEntity $postEntity);
}