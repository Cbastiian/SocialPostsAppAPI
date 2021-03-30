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

        if (Auth::user()->active) {
            return $this->respondWithToken($token);
        } else {
            Auth::invalidate(true);
            return [
                'access_token' => false,
            ];
        }
    }

    public function logout()
    {
        Auth::logout();
    }

    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }

    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'user' => auth()->user()
        ];
    }

    public function me()
    {
        return auth()->user();
    }
}
