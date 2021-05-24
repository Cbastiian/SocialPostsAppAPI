<?php

namespace App\Http\Requests\Api\Product;

use App\Models\User;
use App\Utils\BaseFormRequest;
use App\Dto\Products\CreateProductRatingData;

class CreateProductRatingRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return User::find(auth()->user()->id)->hasRole('regular_user');
    }

    public function rules(): array
    {
        return [
            'value' => ['required', 'numeric'],
            'productId' => ['required']
        ];
    }

    public function data(): CreateProductRatingData
    {
        return new CreateProductRatingData([
            'value' => $this->input('value'),
            'productId' => intval($this->input('productId')),
            'userId' => intval(auth()->user()->id),
            'comment' => $this->input('comment')
        ]);
    }
}
