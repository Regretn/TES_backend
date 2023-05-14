<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentQuestionCollection;
use App\Http\Resources\StudentQuestionResource;
use Illuminate\Http\Request;
use App\Models\StudentQuestion;

class StudentQuestionController extends Controller
{
    public function index()
    {
        $questions = StudentQuestion::all();
        return new StudentQuestionCollection($questions);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'student_question' => 'required|string|max:255',
        ]);

        $question = StudentQuestion::create($validatedData);
        return response()->json($question, 201);
    }

    public function show(string $id)
    {
        $question = StudentQuestion::findOrFail($id);
        return new StudentQuestionResource($question);
    }

    public function update(Request $request, string $id)
    {
        $users = StudentQuestion::all()->where('id', '=', $id)->first();
        $users->student_question = $request->student_question;
        if ($users->save()) {
            return response()->json(['message' => 'Successfully updated'], 200);
        }
        return response()->json(['message' => 'Error, cannot update'], 400);
    }

    public function destroy(string $id)
    {
        $question = StudentQuestion::findOrFail($id);
        $question->delete();
        return response()->json(['message' => 'Question deleted successfully']);
    }
}
