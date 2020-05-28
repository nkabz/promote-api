<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->input('email'))->first();

        if (! Hash::check($request->input('password'), $user->password)) {
            return response()->json([
                'message' => 'Error in login'
            ], 401);
        }

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'accessToken' => $token,
            'tokenType' => 'Bearer',
        ]);
    }
}
