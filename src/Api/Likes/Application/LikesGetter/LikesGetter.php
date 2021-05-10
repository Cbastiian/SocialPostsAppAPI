<?php

declare(strict_types=1);

namespace Src\Api\Likes\Application\LikesGetter;

use Src\Api\Likes\Domain\Contracts\LikesRepository;

final class LikesGetter
{
    private LikesRepository $likesRepository;

    public function __construct(LikesRepository $likesRepository)
    {
        $this->likesRepository = $likesRepository;
    }

    public function __invoke($post)
    {
        return $this->likesRepository->getPostLikers($post);
    }
}
