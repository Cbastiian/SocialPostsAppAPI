<?php

namespace App\Http\Requests\Api\Report;

use App\Models\User;
use App\Dto\Report\GetReportsData;
use Illuminate\Foundation\Http\FormRequest;

class GetReportsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return User::find(auth()->user()->id)->hasRole('admin');
    }

    public function rules(): array
    {
        return [];
    }

    public function data(): GetReportsData
    {
        return new GetReportsData([
            'reportElementType' => strtoupper(request()->reportElementType)
        ]);
    }
}
