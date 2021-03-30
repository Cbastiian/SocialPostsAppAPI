<?php

namespace App\Http\Requests\Api\User;

use App\Dto\User\ResetPasswordData;
use App\Utils\BaseFormRequest;

class ResetPasswordRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'token' => ['required', 'string'],
            'password' => ['required', 'string']
        ];
    }

    public function data(): ResetPasswordData
    {
        return new ResetPasswordData([
            'token' => $this->input('token'),
            'password' => $this->input('password')
        ]);
    }
}
