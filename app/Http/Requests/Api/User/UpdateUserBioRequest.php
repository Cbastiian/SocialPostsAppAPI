<?php

namespace App\Http\Requests\Api\User;

use App\Dto\User\UpdateUserBioData;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserBioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'bio' => ['required']
        ];
    }

    public function data(): UpdateUserBioData
    {
        return new UpdateUserBioData([
            'userId' => auth()->user()->id,
            'bio' => $this->input('bio')
        ]);
    }
}
