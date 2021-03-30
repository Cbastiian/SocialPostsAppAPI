<?php

namespace App\Http\Requests\Api\User;

use App\Dto\User\SendResetPasswordEmailData;
use App\Utils\BaseFormRequest;

class SendResetPasswordEmailRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email']
        ];
    }

    public function data(): SendResetPasswordEmailData
    {
        return new SendResetPasswordEmailData([
            'email' => $this->input('email')
        ]);
    }
}
