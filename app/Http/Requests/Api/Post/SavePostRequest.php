<?php

namespace App\Http\Requests\Api\Post;

use App\Models\User;
use App\Dto\Post\SavePostData;
use App\Utils\BaseFormRequest;
use Illuminate\Support\Facades\Auth;

class SavePostRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return User::find(auth()->user()->id)->hasRole('regular_user');
    }

    public function rules(): array
    {
        return [
            'content' => ['required', 'string'],
            'file' => ['file']
        ];
    }

    public function data(): SavePostData
    {
        return new SavePostData([
            'content' => $this->input('content'),
            'file' => $this->file('file'),
            'userId' => intval(Auth::user()->id)
        ]);
    }
}
