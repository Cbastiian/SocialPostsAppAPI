<?php

namespace App\Http\Requests\Api\Product;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Dto\Products\SaveProductData;
use Illuminate\Foundation\Http\FormRequest;

class SaveProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return User::find(auth()->user()->id)->hasRole('regular_user');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'image' => ['file']
        ];
    }

    public function data(): SaveProductData
    {
        return new SaveProductData([
            'name' => $this->input('name'),
            'description' => $this->input('description'),
            'userComment' => $this->input('userComment'),
            'price' => $this->input('price'),
            'image' => $this->file('image'),
            'userId' => intval(Auth::user()->id)
        ]);
    }
}
