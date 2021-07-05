<?php

namespace App\Http\Requests\Api\History;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use App\Dto\History\ChangeHistoryStatusData;

class ChangeHistoryStatusRequest extends FormRequest
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

    public function data(): ChangeHistoryStatusData
    {
        return new ChangeHistoryStatusData([
            'historyId' => intval(request()->historyId),
            'userId' => intval(auth()->user()->id),
            'status' => $this->input('status')
        ]);
    }
}
