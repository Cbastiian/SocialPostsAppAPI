<?php

namespace App\Http\Requests\Api\Product;

use App\Models\User;
use App\Utils\BaseFormRequest;
use App\Dto\Products\FindProductsByTitleData;

class FindProductByTitleRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return User::find(auth()->user()->id)->hasRole('regular_user');
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'limit' => ['numeric', 'integer', 'min:1'],
            'page' => ['required', 'numeric', 'integer', 'min:1']
        ];
    }

    public function data(): FindProductsByTitleData
    {
        return new FindProductsByTitleData([
            'title' => $this->input('title'),
            'limit' => intval($this->input('limit')),
            'page' => intval($this->input('page')),
        ]);
    }
}
