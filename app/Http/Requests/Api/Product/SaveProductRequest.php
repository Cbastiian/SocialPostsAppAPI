<?php

namespace App\Http\Requests\Api\Product;

use App\Models\User;
use App\Utils\BaseFormRequest;
use Illuminate\Support\Facades\Auth;
use App\Dto\Products\SaveProductData;

class SaveProductRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return User::find(auth()->user()->id)->hasRole('regular_user');
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'image' => ['file']
        ];
    }

    public function data(): SaveProductData
    {
        return new SaveProductData([
            'title' => $this->input('title'),
            'description' => $this->input('description'),
            'userComment' => $this->input('userComment'),
            'price' => $this->input('price'),
            'image' => $this->file('image'),
            'userId' => intval(Auth::user()->id)
        ]);
    }
}
