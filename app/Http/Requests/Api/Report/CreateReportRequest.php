<?php

namespace App\Http\Requests\Api\Report;

use App\Models\User;
use App\Utils\BaseFormRequest;
use App\Dto\Report\CreateReportData;
use Illuminate\Support\Facades\Auth;

class CreateReportRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return User::find(auth()->user()->id)->hasRole('regular_user');
    }

    public function rules(): array
    {
        return [
            'reasonId' => ['required'],
            'reportElementType' => ['required', 'string'],
            'reportElementId' => ['required']
        ];
    }

    public function data(): CreateReportData
    {
        return new CreateReportData([
            'reasonId' => intval($this->input('reasonId')),
            'reportElementType' => strtoupper($this->input('reportElementType')),
            'reportElementId' => intval($this->input('reportElementId')),
            'reportUserId' => intval(Auth::user()->id)
        ]);
    }
}
