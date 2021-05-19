<?php

declare(strict_types=1);

namespace Src\Api\Post\Application\PostStatusChanger;

use Src\Api\Post\Domain\ValueObjects\PostId;
use Src\Api\Shared\Domain\ValueObjects\Status;
use Src\Api\Post\Domain\Contracts\PostRepository;

final class PostStatusChanger
{
    private PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function __invoke(PostId $postId, Status $status)
    {
        $this->postRepository->changePostStatus($postId, $status);
    }
}
