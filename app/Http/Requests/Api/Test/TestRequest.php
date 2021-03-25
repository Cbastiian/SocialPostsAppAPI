<?php

namespace App\Http\Requests\Api\Test;

use App\Dto\Test\TestData;
use App\Utils\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class TestRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'test' => ['required']
        ];
    }

    public function data(): TestData
    {
        return new TestData([
            'test' => $this->input('test')
        ]);
    }
}
