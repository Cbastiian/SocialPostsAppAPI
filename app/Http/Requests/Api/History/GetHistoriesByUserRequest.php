<?php

namespace App\Http\Requests\Api\History;

use App\Models\User;
use App\Utils\BaseFormRequest;
use App\Dto\History\GetHistoriesByUserData;
use Illuminate\Foundation\Http\FormRequest;

class GetHistoriesByUserRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return User::find(auth()->user()->id)->hasRole('regular_user');
    }

    public function rules(): array
    {
        return [];
    }

    public function data(): GetHistoriesByUserData
    {
        return new GetHistoriesByUserData([
            'userId' => intval(request()->userId)
        ]);
    }
}
