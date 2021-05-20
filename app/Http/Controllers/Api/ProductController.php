<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Src\Api\Shared\Domain\Contracts\CommandBus;
use Src\Api\Shared\Domain\Exceptions\DomainError;
use App\Http\Requests\Api\Product\SaveProductRequest;
use Src\Api\Product\Application\ProductCreator\CreateProductCommand;

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
}
