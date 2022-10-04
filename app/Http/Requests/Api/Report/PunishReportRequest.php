<?php

namespace App\Http\Requests\Api\Report;

use App\Models\User;
use App\Utils\BaseFormRequest;
use App\Dto\Report\PunishReportData;

class PunishReportRequest extends BaseFormRequest
{

    public function authorize(): bool
    {
        return User::find(auth()->user()->id)->hasRole('admin');
    }

    public function rules(): array
    {
        return [
            'reportId' => ['required'],
            'message' => ['required'],
            'isPunished' => ['boolean']
        ];
    }

    public function data()
    {
        return new PunishReportData([
            'reportId' => intval($this->input('reportId')),
            'message' => $this->input('message'),
            'isPunished' => $this->input('isPunished'),
        ]);
    }
}
