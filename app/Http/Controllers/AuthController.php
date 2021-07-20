<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    public function auth(LoginRequest $request)
    {
        $request->authenticate();
        $user = $request->user();
        // TODO: tokens don't expire, need to fix that
        $token = $user->createToken('session_token')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ]);
    }
}
