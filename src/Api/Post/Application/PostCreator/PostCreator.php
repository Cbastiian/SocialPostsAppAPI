<?php

declare(strict_types=1);

namespace Src\Api\Post\Application\PostCreator;

use Src\Api\Post\Domain\PostEntity;
use Src\Api\Post\Domain\ValueObjects\Code;
use Src\Api\Post\Domain\ValueObjects\File;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Post\Domain\ValueObjects\Content;
use Src\Api\Post\Domain\Contracts\PostRepository;

final class PostCreator
{
    private PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function __invoke(
        Content $content,
        Code $code,
        ?File $file,
        UserId $userId
    )
    {
        $post = PostEntity::create($content,$code,$file,$userId);

        return $this->postRepository->savePost($post);
    }
}
