<?php

namespace App\Http\Requests\Api\Auth;

use App\Dto\Auth\Login\LoginData;
use App\Utils\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => ['required', 'string'],
            'password' => ['required', 'string']
        ];
    }

    public function data(): LoginData
    {
        return new LoginData([
            'username' => $this->input('username'),
            'password' => $this->input('password')
        ]);
    }
}
