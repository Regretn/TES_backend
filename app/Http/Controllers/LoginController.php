<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $credentials = $request->only(['email', 'password']);
        $user = User::all()->where('email', '=', $request->email)->first();

        if ($user && $credentials['password'] === $user->password) {
            if ($user->role_id == '1') {
                $token = $user->createToken('token')->plainTextToken;
                return response()->json(['token' => $token, 'role' => '1'], 200);
            } else {
                $token = $user->createToken('token')->plainTextToken;
                return response()->json(['token' => $token, 'role' => '2'], 200);
            }
        } else {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }
    public function logout(Request $request)
    {
        if ($request->user()->currentAccessToken()->delete()) {
            return [
                'message' => 'Successfully logged out!'
            ];
        }
    }
}
