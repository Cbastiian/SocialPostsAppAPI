<?php

namespace App\Http\Requests\Api\Product;

use App\Models\User;
use App\Utils\BaseFormRequest;
use App\Dto\Products\CreateFavoriteData;

class CreateFavoriteRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return User::find(auth()->user()->id)->hasRole('regular_user');
    }

    public function rules(): array
    {
        return [];
    }

    public function data()
    {
        return new CreateFavoriteData([
            'productId' => intval(request()->productId),
            'userId' => intval(auth()->user()->id)
        ]);
    }
}
