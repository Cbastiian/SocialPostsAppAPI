<?php

namespace App\Http\Requests\Api\Product;

use App\Models\User;
use App\Dto\Products\RemoveFavoriteData;
use Illuminate\Foundation\Http\FormRequest;

class RemoveFavoriteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return User::find(auth()->user()->id)->hasRole('regular_user');
    }

    public function rules(): array
    {
        return [];
    }

    public function data(): RemoveFavoriteData
    {
        return new RemoveFavoriteData([
            'productId' => intval(request()->productId),
            'userId' => intval(auth()->user()->id)
        ]);
    }
}
