<?php

namespace App\Http\Requests\Api\Product;

use App\Models\User;
use App\Utils\BaseFormRequest;
use App\Dto\Products\UpdateProductRatingData;

class UpdateProductRatingRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return User::find(auth()->user()->id)->hasRole('regular_user');
    }

    public function rules(): array
    {
        return [
            'value' => ['required', 'numeric']
        ];
    }

    public function data()
    {
        return new UpdateProductRatingData([
            'value' => $this->input('value'),
            'productId' => intval(request()->productId),
            'userId' => intval(auth()->user()->id),
            'comment' => $this->input('comment')
        ]);
    }
}
