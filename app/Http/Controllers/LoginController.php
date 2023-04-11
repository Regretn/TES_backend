<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\RateLimiter;


class LoginController extends Controller
{
    public function login(Request $request)
    {

        // $key = $request->ip();
        // if ($limiter->tooManyAttempts($key, 5)) {
        //     // Return a response with a 429 status code (Too Many Requests)
        //     $response = response()->json(['error' => 'Too many login attempts.'], 429);
        //     $retryAfter = $limiter->availableIn($key);
        //     return $response->header('Retry-After', $retryAfter);
        // }
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        //this part authenticate the login request
        $type = $request->user->role;
        $credentials = $request->only(['email', 'password']);
        $user = User::where('email', $credentials['email'])->first();

        //this one check the pass and user then their role with limited try
        if ($user || ($credentials['password'] == $user->password)) {
            if ($type === '1') {
                $token = $user->createToken('token')->plainTextToken;
                return response()->json(['token' => $token], 200);
            }
            if ($type === '2') {
                $token = $user->createToken('token')->plainTextToken;
                return response()->json(['token' => $token], 200);
            } else {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } else {
            // If the credentials are invalid, increment the login attempt counter
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect('/login');
    }
}
