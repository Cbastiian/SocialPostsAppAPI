<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Http\Controllers\Controller;
use Src\Api\Shared\Domain\Contracts\CommandBus;
use Src\Api\Shared\Domain\Exceptions\DomainError;
use App\Http\Requests\Api\Product\SaveProductRequest;
use App\Http\Requests\Api\Product\UpdateProductRequest;
use App\Http\Requests\Api\Product\GetProductByCodeRequest;
use App\Http\Requests\Api\Product\GetProductsByUserRequest;
use App\Http\Requests\Api\Product\ChangeProductImageRequest;
use App\Http\Requests\Api\Product\GetGeneralProductsRequest;
use App\Http\Requests\Api\Product\ChangeProductStatusRequest;
use Src\Api\Product\Application\ProductCreator\CreateProductCommand;
use Src\Api\Product\Application\ProductUpdater\UpdateProductCommand;
use Src\Api\Product\Application\ProductByCodeGetter\GetProductByCodeCommand;
use Src\Api\Product\Application\ProductImageUpdater\ChangeProductImageCommand;
use Src\Api\Product\Application\ProductsByUserGetter\GetProductsByUserCommand;
use Src\Api\Product\Application\GeneralProductsGetter\GetGeneralProductsCommand;
use Src\Api\Product\Application\ProductStatusChanger\ChangeProductStatusCommand;

class ProductController extends Controller
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;;
    }

    public function saveProduct(SaveProductRequest $saveProductRequest)
    {
        try {
            $data = $saveProductRequest->data();

            $command = new CreateProductCommand(
                $data->title,
                $data->price,
                $data->description,
                $data->userComment,
                $data->image,
                $data->userId
            );

            $product = $this->commandBus->execute($command);

            return response()->json($product, 201);
        } catch (DomainError $error) {
            return response()->json([
                "code" => $error->errorCode(),
                "detail" => $error->errorMessage()
            ], 422);
        } catch (Exception $th) {
            return response()->json([
                'code' => $th->getCode(),
                'detail' => $th->getMessage()
            ], 500);
        }
    }

    public function updateProduct(UpdateProductRequest $updateProductRequest)
    {
        try {
            $data = $updateProductRequest->data();

            $command = new UpdateProductCommand(
                $data->productId,
                $data->title,
                $data->description,
                $data->userComment,
                $data->price,
                $data->userId
            );

            $this->commandBus->execute($command);

            return response()->json([], 204);
        } catch (DomainError $error) {
            return response()->json([
                "code" => $error->errorCode(),
                "detail" => $error->errorMessage()
            ], 422);
        } catch (Exception $th) {
            return response()->json([
                'code' => $th->getCode(),
                'detail' => $th->getMessage()
            ], 500);
        }
    }

    public function changerProductStatus(ChangeProductStatusRequest $changeProductStatusRequest)
    {
        try {
            $data = $changeProductStatusRequest->data();

            $command = new ChangeProductStatusCommand(
                $data->productId,
                $data->status,
                $data->userId
            );

            $this->commandBus->execute($command);

            return response()->json([], 204);
        } catch (DomainError $error) {
            return response()->json([
                "code" => $error->errorCode(),
                "detail" => $error->errorMessage()
            ], 422);
        } catch (Exception $th) {
            return response()->json([
                'code' => $th->getCode(),
                'detail' => $th->getMessage()
            ], 500);
        }
    }

    public function changeProductImage(ChangeProductImageRequest $changeProductImageRequest)
    {
        try {
            $data = $changeProductImageRequest->data();

            $command = new ChangeProductImageCommand(
                $data->productId,
                $data->image,
                $data->userId
            );

            $this->commandBus->execute($command);

            return response()->json([], 204);
        } catch (DomainError $error) {
            return response()->json([
                "code" => $error->errorCode(),
                "detail" => $error->errorMessage()
            ], 422);
        } catch (Exception $th) {
            return response()->json([
                'code' => $th->getCode(),
                'detail' => $th->getMessage()
            ], 500);
        }
    }

    public function getGeneralProducts(GetGeneralProductsRequest $getGeneralProductsRequest)
    {
        try {
            $command = new GetGeneralProductsCommand();

            $products = $this->commandBus->execute($command);

            return response()->json($products, 200);
        } catch (DomainError $error) {
            return response()->json([
                "code" => $error->errorCode(),
                "detail" => $error->errorMessage()
            ], 422);
        } catch (Exception $th) {
            return response()->json([
                'code' => $th->getCode(),
                'detail' => $th->getMessage()
            ], 500);
        }
    }

    public function getProductsByUser(GetProductsByUserRequest $getProductsByUserRequest)
    {
        try {
            $data = $getProductsByUserRequest->data();

            $command = new GetProductsByUserCommand($data->username);

            $products = $this->commandBus->execute($command);

            return response()->json($products, 200);
        } catch (DomainError $error) {
            return response()->json([
                "code" => $error->errorCode(),
                "detail" => $error->errorMessage()
            ], 422);
        } catch (Exception $th) {
            return response()->json([
                'code' => $th->getCode(),
                'detail' => $th->getMessage()
            ], 500);
        }
    }

    public function getProductByCode(GetProductByCodeRequest $getProductByCodeRequest)
    {
        try {
            $data = $getProductByCodeRequest->data();

            $command = new GetProductByCodeCommand($data->productCode);

            $product = $this->commandBus->execute($command);

            return response()->json($product, 200);
        } catch (DomainError $error) {
            return response()->json([
                "code" => $error->errorCode(),
                "detail" => $error->errorMessage()
            ], 422);
        } catch (Exception $th) {
            return response()->json([
                'code' => $th->getCode(),
                'detail' => $th->getMessage()
            ], 500);
        }
    }
}
