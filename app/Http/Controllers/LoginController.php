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
        $user = User::all()->where('email', '=', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            if ($user->role_id == '1') {
                $token = $user->createToken('token')->plainTextToken;
                $user->token = $token;
                $user->save();
                return response()->json(['token' => $token, 'user_id' => $user->id, 'role' => '1'], 200);
            } else {
                $token = $user->createToken('token')->plainTextToken;
                $user->token = $token;
                $user->save();
                return response()->json(['token' => $token, 'user_id' => $user->id, 'role' => '2'], 200);
            }
        } else {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }

    public function logout(Request $request)
    {
        $sentToken = $request->input('token');

        $user = User::where('token', $sentToken)->first();

        if ($user) {
            $user->token = null;
            $user->save();

            return response()->json([
                'message' => 'Successfully logged out'
            ], 200);
        }

        return response()->json([
            'message' => 'Invalid or expired token'
        ], 401);
    }
}
