<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class StudentLoginController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_lrn' => 'required|unique:students|max:10|min:6',
            'section_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $student = Student::create([
            'student_lrn' => $request->input('student_lrn'),
            'section_id' => $request->input('section_id'),
        ]);

        Auth::login($student);
        $token = $student->createToken('auth_token');

        $student->update([
            'token' => $token->plainTextToken
        ]);

        $responseData = [
            'id' => $student->id,
            'lrn' => $student->student_lrn,
            'section_id' => $student->section_id,
            'token' => $token->plainTextToken
        ];

        return response()->json($responseData, 200);
    }

    public function logout(Request $request)
    {

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
