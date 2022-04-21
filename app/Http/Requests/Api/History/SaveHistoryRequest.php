<?php

namespace App\Http\Requests\Api\History;

use App\Models\User;
use App\Utils\BaseFormRequest;
use App\Dto\History\SaveHistoryData;

class SaveHistoryRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return User::find(auth()->user()->id)->hasRole('regular_user');
    }

    public function rules(): array
    {
        return [
            'file' => ['required', 'file']
        ];
    }

    public function data(): SaveHistoryData
    {
        return new SaveHistoryData([
            'comment' => $this->input('comment'),
            'userId' => intval(auth()->user()->id),
            'file' => $this->file('file'),
        ]);
    }
}
