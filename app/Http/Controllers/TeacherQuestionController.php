<?php

namespace App\Http\Controllers;

use App\Http\Resources\TeacherQuestionCollection;
use App\Http\Resources\TeacherQuestionResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\TeacherQuestion;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TeacherQuestionController extends Controller

{
    public function index()
    {
        $questions = TeacherQuestion::all();
        return new TeacherQuestionCollection($questions);
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

    public function update(Request $request)
    {
        $request->validate([
            'questions' => 'required|array',
            'questions.*.id' => 'required|exists:teacher_questions,id',
            'questions.*.teacher_question' => 'required|string|max:255',
        ]);

        $updatedQuestions = [];

        foreach ($request->questions as $item) {
            $question = TeacherQuestion::find($item['id']);

            if (!$question) {
                return response()->json(['message' => 'Question not found'], 404);
            }

            $question->teacher_question = $item['teacher_question'];
            $question->save();

            $updatedQuestions[] = $question;
        }

        return response()->json($updatedQuestions);
    }



    public function destroy(string $id)
    {
        $question = TeacherQuestion::findOrFail($id);
        $question->delete();
        return response()->json(['message' => 'Question deleted successfully']);
    }
}
