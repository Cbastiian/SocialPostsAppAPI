<?php

namespace App\Http\Requests\Api\Product;

use App\Models\User;
use App\Utils\BaseFormRequest;
use Illuminate\Support\Facades\Auth;
use App\Dto\Products\UpdateProductData;

class UpdateProductRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return User::find(auth()->user()->id)->hasRole('regular_user');
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'price' => ['required', 'numeric']
        ];
    }

    public function data(): UpdateProductData
    {
        return new UpdateProductData([
            'productId' => intval(request()->productId),
            'title' => $this->input('title'),
            'description' => $this->input('description'),
            'userComment' => $this->input('userComment'),
            'price' => $this->input('price'),
            'userId' => intval(Auth::user()->id)
        ]);
    }
}
