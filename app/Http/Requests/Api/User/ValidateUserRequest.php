<?php

namespace App\Http\Requests\Api\User;

use App\Dto\User\ValidateUserData;
use App\Utils\BaseFormRequest;

class ValidateUserRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'string'],
            'otpCode' => ['required', 'string']
        ];
    }

    public function data(): ValidateUserData
    {
        return new ValidateUserData([
            'email' => $this->input('email'),
            'otpCode' => $this->input('otpCode')
        ]);
    }
}
