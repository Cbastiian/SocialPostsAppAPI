<?php

declare(strict_types=1);

namespace Src\Api\Post\Application\PostGetter;

use Src\Api\Post\Domain\ValueObjects\PostId;
use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\Comment\Application\CommentsGetter\CommentsGetter;

final  class GetPostsHandler implements CommandHandler
{
    private PostGetter $postGetter;
    private CommentsGetter $commnetsGetter;

    public function __construct(
        PostGetter $postGetter,
        CommentsGetter $commnetsGetter
    ) {
        $this->postGetter = $postGetter;
        $this->commnetsGetter = $commnetsGetter;
    }

    public function execute($command)
    {
        $posts = $this->postGetter->__invoke();

        foreach ($posts as $post) {
            $postId = new PostId($post->id);
            $post->comments = $this->commnetsGetter->__invoke($postId);
        }

        return $posts;
    }
}
