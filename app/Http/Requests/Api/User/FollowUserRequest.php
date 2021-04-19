<?php

namespace App\Http\Requests\Api\User;

use App\Utils\BaseFormRequest;
use App\Dto\User\FollowUserData;

class FollowUserRequest extends BaseFormRequest
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

    public function data(): FollowUserData
    {
        return new FollowUserData([
            'followingUserId' => intval($this->input('followingUserId'))
        ]);
    }
}
