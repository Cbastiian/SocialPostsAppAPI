<?php

declare(strict_types=1);

namespace Src\Api\Post\Application;

use Src\Api\Post\Domain\Contracts\PostRepository;

final class ListReportedPost
{
    public PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function __invoke()
    {
        return $this->postRepository->getReportedPost();
    }
}
