<?php

namespace App\Http\Requests\Api\Like;

use App\Models\User;
use App\Dto\Like\ToggleLikeData;
use Illuminate\Foundation\Http\FormRequest;

class ToggleLikeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return User::find(auth()->user()->id)->hasRole('regular_user');
    }

    public function rules(): array
    {
        return [
            'postId' => ['required']
        ];
    }

    public function data(): ToggleLikeData
    {
        return new ToggleLikeData([
            'userId' => intval(auth()->user()->id),
            'postId' => intval($this->input('postId'))
        ]);
    }
}
