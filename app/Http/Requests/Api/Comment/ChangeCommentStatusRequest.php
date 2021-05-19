<?php

namespace App\Http\Requests\Api\Comment;

use App\Models\User;
use App\Utils\BaseFormRequest;
use App\Dto\Comment\ChangeCommentStatusData;

class ChangeCommentStatusRequest extends BaseFormRequest
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

    public function data(): ChangeCommentStatusData
    {
        return new ChangeCommentStatusData([
            'commentId' => intval(request()->commentId),
            'status' => $this->input('status')
        ]);
    }
}
