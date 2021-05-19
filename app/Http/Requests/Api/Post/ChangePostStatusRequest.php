<?php

namespace App\Http\Requests\Api\Post;

use App\Models\User;
use App\Utils\BaseFormRequest;
use App\Dto\Post\ChangePostStatusData;

class ChangePostStatusRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return User::find(auth()->user()->id)->hasRole('regular_user');
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'boolean']
        ];
    }

    public function data(): ChangePostStatusData
    {
        return new ChangePostStatusData([
            'postId' => intval(request()->postId),
            'status' => $this->input('status')
        ]);
    }
}
