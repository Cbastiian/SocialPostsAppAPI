<?php

namespace App\Http\Requests\Api\Report;

use App\Dto\Report\GetReportsData;
use Illuminate\Foundation\Http\FormRequest;

class GetReportsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [];
    }

    public function data(): GetReportsData
    {
        return new GetReportsData([
            'reportElementType' => request()->reportElementType
        ]);
    }
}
