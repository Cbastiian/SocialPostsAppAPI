<?php

namespace App\Http\Requests\Api\User;

use App\Utils\BaseFormRequest;
use App\Dto\User\UpdateUserProfilePhotoData;

class UpdateUserProfilePhotoRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return User::find(auth()->user()->id)->hasRole('regular_user');
    }

    public function rules(): array
    {
        return [
            'photo' => ['file']
        ];
    }

    public function data(): UpdateUserProfilePhotoData
    {
        return new UpdateUserProfilePhotoData([
            'photo' => $this->file('photo')
        ]);
    }
}
