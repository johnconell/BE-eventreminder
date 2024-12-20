<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            $token = bin2hex(random_bytes(16));
            return [
                'message' => 'Login successful', 
                'token' => $token
            ];
        }

        return ['message' => 'Login failed.'];
    }
}
