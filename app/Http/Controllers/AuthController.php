<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    public function auth(LoginRequest $request)
    {
        $request->authenticate();
        $user = $request->user();
        $token = $user->createToken('session_token')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ]);
    }
}
