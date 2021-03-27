<?php

namespace App\Http\Requests\User;

use App\Dto\User\CreateUserData;
use App\Utils\BaseFormRequest;

class CreateUserRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'string'],
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
            'photo' => ['file']
        ];
    }

    public function data(): CreateUserData
    {
        return new CreateUserData([
            'name' => $this->input('name'),
            'email' => $this->input('email'),
            'username' => $this->input('username'),
            'password' => $this->input('password'),
            'photo' => $this->file('photo')
        ]);
    }
}
