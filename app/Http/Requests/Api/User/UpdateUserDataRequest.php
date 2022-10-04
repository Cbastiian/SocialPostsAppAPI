<?php

namespace App\Http\Requests\Api\User;

use App\Models\User;
use App\Utils\BaseFormRequest;
use App\Dto\User\UpdateUserData;

class UpdateUserDataRequest extends BaseFormRequest
{

    public function authorize(): bool
    {
        return User::find(auth()->user()->id)->hasRole('regular_user');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'username' => ['required', 'string']
        ];
    }

    public function data(): UpdateUserData
    {
        return new UpdateUserData([
            'userId' => auth()->user()->id,
            'name' => $this->input('name'),
            'email' => $this->input('email'),
            'username' => $this->input('username')
        ]);
    }
}
