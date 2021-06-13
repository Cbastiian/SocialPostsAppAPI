<?php

namespace App\Http\Requests\Api\Product;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use App\Dto\Products\ChangeProductImageData;

class ChangeProductImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return User::find(auth()->user()->id)->hasRole('regular_user');
    }

    public function rules(): array
    {
        return [
            'image' => ['required', 'file']
        ];
    }

    public function data(): ChangeProductImageData
    {
        return new ChangeProductImageData([
            'productId' => intval(request()->productId),
            'image' => $this->file('image'),
            'userId' => intval(Auth::user()->id)
        ]);
    }
}
