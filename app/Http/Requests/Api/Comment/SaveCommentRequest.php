<?php

namespace App\Http\Requests\Api\Comment;

use App\Utils\BaseFormRequest;
use App\Dto\Comment\SaveCommentData;
use Illuminate\Support\Facades\Auth;

class SaveCommentRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => ['required', 'string'],
            'postId' => ['required']
        ];
    }

    public function data(): SaveCommentData
    {
        return new SaveCommentData([
            'content' => $this->input('content'),
            'postId' => intval($this->input('postId')),
            'commentatorUserId' => intval(Auth::user()->id)
        ]);
    }
}
