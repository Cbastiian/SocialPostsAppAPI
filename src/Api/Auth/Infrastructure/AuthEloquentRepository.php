<?php

namespace Src\Api\Auth\Infrastructure;

use Illuminate\Support\Facades\Auth;
use Src\Api\Auth\Domain\Contracts\AuthRepository;
use Src\Api\Auth\Domain\ValueObjects\Credentials;

final class AuthEloquentRepository implements AuthRepository
{
    public function login(Credentials $credentials)
    {
        $token = Auth::attempt($credentials->value());
        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'user' => auth()->user()
        ];
    }
}
