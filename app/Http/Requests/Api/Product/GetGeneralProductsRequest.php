<?php

namespace App\Http\Requests\Api\Product;

use App\Models\User;
use App\Utils\BaseFormRequest;
use App\Dto\Products\GetGeneralProductsDate;

class GetGeneralProductsRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return User::find(auth()->user()->id)->hasRole('regular_user');
    }

    public function rules(): array
    {
        return [
            'limit' => ['numeric', 'integer', 'min:1'],
            'page' => ['required', 'numeric', 'integer', 'min:1']
        ];
    }

    public function data(): GetGeneralProductsDate
    {
        return new GetGeneralProductsDate([
            'limit' => intval($this->input('limit')),
            'page' => intval($this->input('page'))
        ]);
    }
}
