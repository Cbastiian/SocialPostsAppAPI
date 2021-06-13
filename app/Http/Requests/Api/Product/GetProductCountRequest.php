<?php

namespace App\Http\Requests\Api\Product;

use App\Models\User;
use App\Dto\Products\GetProductCountData;
use Illuminate\Foundation\Http\FormRequest;

class GetProductCountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return User::find(auth()->user()->id)->hasRole('regular_user');
    }

    public function rules(): array
    {
        return [];
    }

    public function data(): GetProductCountData
    {
        return new GetProductCountData([
            'userId' => intval(request()->userId)
        ]);
    }
}
