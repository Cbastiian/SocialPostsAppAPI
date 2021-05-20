<?php

namespace App\Http\Requests\Api\Product;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use App\Dto\Products\ChangeProductStatusData;

class ChangeProductStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return User::find(auth()->user()->id)->hasRole('regular_user');
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'boolean']
        ];
    }

    public function data(): ChangeProductStatusData
    {
        return new ChangeProductStatusData([
            'productId' => intval(request()->productId),
            'status' => $this->input('status'),
            'userId' => intval(Auth::user()->id)
        ]);
    }
}
