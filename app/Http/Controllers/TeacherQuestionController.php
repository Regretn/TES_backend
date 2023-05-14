<?php

namespace App\Http\Controllers;

use App\Http\Resources\TeacherQuestionCollection;
use App\Http\Resources\TeacherQuestionResource;
use Illuminate\Http\Request;
use App\Models\TeacherQuestion;

class TeacherQuestionController extends Controller
{
    public function show($id)
    {
        $user = User::with('sections')->whereHas('sections')->find($id);

        if (!$user) {
            // User not found
            return response()->json(['message' => 'User not found'], 404);
        }

        return new UserResource($user);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'teacher_question' => 'required|string|max:255',
        ]);

        $question = TeacherQuestion::create($validatedData);
        return response()->json($question, 201);
    }

    public function show(string $id)
    {
        $question = TeacherQuestion::findOrFail($id);
        return new TeacherQuestionResource($question);
    }

    public function update(Request $request, string $id)
    {
        $question = TeacherQuestion::findOrFail($id);
        $question->teacher_question = (string) $request->teacher_question;

        if ($question->save()) {
            return response()->json(['message' => 'Successfully updated'], 200);
        }

        return response()->json(['message' => 'Error, cannot update question'], 400);
    }



    public function destroy(string $id)
    {
        $question = TeacherQuestion::findOrFail($id);
        $question->delete();
        return response()->json(['message' => 'Question deleted successfully']);
    }
}
