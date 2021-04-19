<?php

namespace App\Http\Requests\Api\User;

use App\Utils\BaseFormRequest;
use App\Dto\User\UnfollowUserData;

class UnfollowUserRequest   extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'followingUserId' => ['required', 'numeric']
        ];
    }

    public function data(): UnfollowUserData
    {
        return new UnfollowUserData([
            'followingUserId' => intval($this->input('followingUserId'))
        ]);
    }
}
