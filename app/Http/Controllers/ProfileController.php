<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();

        $user->user_name = $request->user_name;
        $user->email = $request->email;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName);
            $user->image = $imageName;
        }

        $user->description = $request->description;

        $user->save();

        return response()->json(['message' => 'Profile updated successfully'], 200);
    }
}
