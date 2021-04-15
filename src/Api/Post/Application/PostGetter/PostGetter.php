<?php

declare(strict_types=1);

namespace Src\Api\Post\Application\PostGetter;

use Src\Api\Post\Domain\Contracts\PostRepository;

final class PostGetter
{
    private PostRepository $postRepository;

    public function __construct(
        PostRepository $postRepository
    ) {
        $this->postRepository = $postRepository;
    }

    public function __invoke()
    {
        return $this->postRepository->getPosts();
    }
}
