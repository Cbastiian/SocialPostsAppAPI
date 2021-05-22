<?php

namespace Src\Api\Product\Infrastructure;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Src\Api\Product\Domain\ProductEntity;
use Src\Api\Shared\Domain\ValueObjects\Page;
use Src\Api\Shared\Domain\ValueObjects\Image;
use Src\Api\Shared\Domain\ValueObjects\Limit;
use Src\Api\Product\Domain\ValueObjects\Title;
use Src\Api\Shared\Domain\ValueObjects\Status;
use Src\Api\User\Domain\ValueObjects\Username;
use Src\Api\Product\Domain\ValueObjects\ProductId;
use Src\Api\Product\Domain\ValueObjects\ProductCode;
use Src\Api\Product\Domain\Contracts\ProductRepository;

final class ProductEloquentRepository implements ProductRepository
{
    public function saveProduct(ProductEntity $productEntity)
    {
        return Product::create($productEntity->toCreateArray());
    }

    public function updateProduct(ProductId $productId, ProductEntity $productEntity)
    {
        Product::where('id', $productId->value())
            ->first()
            ->update($productEntity->toUpdateArray());
    }

    public function changeProductStatus(ProductId $productId, Status $status)
    {
        Product::where('id', $productId->value())
            ->first()
            ->update(
                ['active' => intval($status->value())]
            );
    }

    public function changeProductImage(ProductId $productId, Image $image)
    {
        Product::where('id', $productId->value())
            ->first()
            ->update(
                ['image' => $image->value()]
            );
    }

    public function getGeneralProducts()
    {
        return Product::join('users', 'users.id', '=', 'products.user_id')
            ->select(
                'products.title as product_title',
                'products.description as product_description',
                'products.user_comment as user_comment',
                'products.product_code',
                'products.image as product_image',
                'products.price as product_price',
                'users.name as user_fullname',
                'users.username',
                'users.photo as user_photo'
            )
            ->where([
                ['products.active', intval(true)],
                ['users.active', intval(true)]
            ])
            ->get();
    }

    public function getProductsByUser(Username $username)
    {
        return Product::join('users', 'users.id', '=', 'products.user_id')
            ->select(
                'products.title as product_title',
                'products.description as product_description',
                'products.user_comment as user_comment',
                'products.product_code',
                'products.image as product_image',
                'products.price as product_price',
                'users.name as user_fullname',
                'users.username',
                'users.photo as user_photo'
            )
            ->where([
                ['products.active', intval(true)],
                ['users.username', $username->value()],
                ['users.active', intval(true)]
            ])
            ->get();
    }

    public function getProductByCode(ProductCode $productCode)
    {
        return Product::join('users', 'users.id', '=', 'products.user_id')
            ->select(
                'products.title as product_title',
                'products.description as product_description',
                'products.user_comment as user_comment',
                'products.product_code',
                'products.image as product_image',
                'products.price as product_price',
                'users.name as user_fullname',
                'users.username',
                'users.photo as user_photo'
            )
            ->where('product_code', $productCode->value())
            ->first();
    }

    public function findProductByCoincidence(Title $title, Limit $limit, Page $page)
    {
        $convertedTitle = Str::ascii($title->value());

        return Product::join('users', 'users.id', '=', 'products.user_id')
            ->select(
                'products.title as product_title',
                'products.description as product_description',
                'products.user_comment as user_comment',
                'products.product_code',
                'products.image as product_image',
                'products.price as product_price',
                'users.name as user_fullname',
                'users.username',
                'users.photo as user_photo'
            )
            ->where([
                ['products.title', 'LIKE', '%' . $convertedTitle . '%'],
                ['products.active', intval(true)]
            ])
            ->paginate(
                $limit->value(),
                null,
                null,
                $page->value()
            );
    }

    public function findProductById(ProductId $productId)
    {
        return Product::where('id', $productId->value())->first();
    }
}