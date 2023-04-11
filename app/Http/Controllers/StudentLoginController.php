<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentLoginController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'student_lrn' => 'required|unique:users|max:25',
            'student_section' => 'required|min:6|max:255|confirmed',
        ]);

        $student = Student::create([
            'student_lrn' => $validatedData['student_lrn'],
            'student_section' => $validatedData['student_section'],
        ]);

        auth()->login($student);
        return redirect('/student');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect('/login');
    }
}
