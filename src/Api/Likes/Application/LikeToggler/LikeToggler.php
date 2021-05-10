<?php

declare(strict_types=1);

namespace Src\Api\Likes\Application\LikeToggler;

use Src\Api\Likes\Domain\Contracts\LikesRepository;

final class LikeToggler
{
    private LikesRepository $likesRepository;

    public function __construct(LikesRepository $likesRepository)
    {
        $this->likesRepository = $likesRepository;
    }

    public function __invoke($user, $post)
    {
        return $this->likesRepository->toggleLike($user, $post);
    }
}
