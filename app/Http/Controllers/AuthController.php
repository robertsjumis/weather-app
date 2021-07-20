<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function auth(LoginRequest $request)
    {
        Log::debug("AuthController::auth()");
        $request->authenticate();
        Log::debug("User authenticated successfully");
        $user = $request->user();
        // TODO: tokens don't expire, need to fix that
        $token = $user->createToken('session_token')->plainTextToken;
        Log::debug("Token created!");
        return response([
            'user' => $user,
            'token' => $token
        ]);
    }
}
