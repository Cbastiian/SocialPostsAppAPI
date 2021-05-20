<?php

namespace App\Http\Requests\Api\Product;

use App\Models\User;
use App\Dto\Products\GetProductByCodeData;
use Illuminate\Foundation\Http\FormRequest;

class GetProductByCodeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return User::find(auth()->user()->id)->hasRole('regular_user');
    }

    public function rules(): array
    {
        return [];
    }

    public function data(): GetProductByCodeData
    {
        return new GetProductByCodeData([
            'productCode' => request()->productCode
        ]);
    }
}
