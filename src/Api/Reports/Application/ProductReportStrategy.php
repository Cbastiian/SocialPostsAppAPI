<?php

namespace Src\Api\Reports\Application;

use Src\Api\Shared\Domain\ValueObjects\Status;
use Src\Api\Product\Domain\ValueObjects\ProductId;
use Src\Api\Product\Application\ListReportedProducts;
use Src\Api\Product\Domain\Contracts\ProductRepository;
use Src\Api\Product\Domain\Contracts\ProductValidation;
use Src\Api\Reports\Domain\ValueObjects\ReportElementId;
use Src\Api\Reports\Domain\Contracts\ReportElementStrategy;

final class ProductReportStrategy implements ReportElementStrategy
{
    private ?ProductValidation $productValidation;
    private ?ListReportedProducts $listReportedProducts;
    private ?ProductRepository $productRepository;

    public function __construct(
        ?ProductValidation $productValidation,
        ?ListReportedProducts $listReportedProducts,
        ?ProductRepository $productRepository
    ) {
        $this->productValidation = $productValidation;
        $this->listReportedProducts = $listReportedProducts;
        $this->productRepository = $productRepository;
    }

    public function executeElementValidtion(ReportElementId $reportElementId)
    {
        $productId = new ProductId($reportElementId->value());

        $this->productValidation->throwIfProductIdNotExist($productId);
    }

    public function executeElementGetter()
    {
        return $this->listReportedProducts->__invoke();
    }

    public function executeElementPunish(ReportElementId $reportElementId)
    {
        $productId = new ProductId($reportElementId->value());
        $status = new Status(false);

        $this->productRepository->changeProductStatus($productId, $status);
    }
}
