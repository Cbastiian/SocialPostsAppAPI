<?php

namespace App\Http\Requests\Api\User;

use App\Dto\User\ResendVerificationEmailData;
use App\Utils\BaseFormRequest;

class ResendVerificationEmailRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'string']
        ];
    }

    public function data(): ResendVerificationEmailData
    {
        return new ResendVerificationEmailData([
            'email' =>  $this->input('email')
        ]);
    }
}
