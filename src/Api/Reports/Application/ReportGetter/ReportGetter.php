<?php

declare(strict_types=1);

namespace Src\Api\Reports\Application\ReportGetter;

use Src\Api\Post\Application\ListReportedPost;
use Src\Api\User\Application\ListReportedUsers;
use Src\Api\Reports\Domain\ReportElementContext;
use Src\Api\Post\Domain\Contracts\PostValidation;
use Src\Api\User\Domain\Contracts\UserValidation;
use Src\Api\Reports\Application\PostReportStrategy;
use Src\Api\Reports\Application\UserReportStrategy;
use Src\Api\Comment\Application\ListReportedComments;
use Src\Api\Product\Application\ListReportedProducts;
use Src\Api\Reports\Application\CommentReportStrategy;
use Src\Api\Reports\Application\ProductReportStrategy;
use Src\Api\Reports\Domain\Contracts\ReportValidation;
use Src\Api\Comment\Domain\Contracts\CommentValidation;
use Src\Api\Product\Domain\Contracts\ProductValidation;
use Src\Api\Reports\Domain\ValueObjects\ReportElementType;

final class ReportGetter
{
    private ReportValidation $reportValidation;
    private CommentValidation $commentValidation;
    private PostValidation $postValidation;
    private UserValidation $userValidation;
    private ProductValidation $productValidation;
    private ListReportedComments $listReportedComments;
    private ListReportedPost $listReportedPost;
    private ListReportedUsers $listReportedUsers;
    private ListReportedProducts $listReportedProducts;

    public function __construct(
        ReportValidation $reportValidation,
        CommentValidation $commentValidation,
        PostValidation $postValidation,
        UserValidation $userValidation,
        ProductValidation $productValidation,
        ListReportedComments $listReportedComments,
        ListReportedPost $listReportedPost,
        ListReportedUsers $listReportedUsers,
        ListReportedProducts $listReportedProducts
    ) {
        $this->reportValidation = $reportValidation;
        $this->commentValidation = $commentValidation;
        $this->postValidation = $postValidation;
        $this->userValidation = $userValidation;
        $this->productValidation = $productValidation;
        $this->listReportedComments = $listReportedComments;
        $this->listReportedPost = $listReportedPost;
        $this->listReportedUsers = $listReportedUsers;
        $this->listReportedProducts = $listReportedProducts;
    }

    public function __invoke(ReportElementType $reportElementType)
    {
        $strategyData = $this->getStrategy($reportElementType);

        $context = new ReportElementContext($strategyData);

        return $context->executeGetterStrategy();
    }

    public function getStrategy(ReportElementType $reportElementType)
    {
        switch ($reportElementType->value()) {
            case 'COMMENT':
                $strategy =  new CommentReportStrategy($this->commentValidation, $this->listReportedComments);
                break;
            case 'POST':
                $strategy =  new PostReportStrategy($this->postValidation, $this->listReportedPost);
                break;
            case 'USER':
                $strategy = new UserReportStrategy($this->userValidation, $this->listReportedUsers);
                break;
            case 'PRODUCT':
                $strategy = new ProductReportStrategy($this->productValidation, $this->listReportedProducts);
                break;
            default:
                $this->reportValidation->throwIfReportEntityInvalid($reportElementType);
        }

        return $strategy;
    }
}
