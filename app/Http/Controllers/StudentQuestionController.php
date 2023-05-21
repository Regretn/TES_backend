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

    public function update(Request $request)
    {
        $request->validate([
            'questions' => 'required|array',
            'questions.*.id' => 'required|exists:student_questions,id',
            'questions.*.student_question' => 'required|string|max:255',
        ]);

        $updatedQuestions = [];

        foreach ($request->questions as $item) {
            $question = StudentQuestion::find($item['id']);

            if (!$question) {
                return response()->json(['message' => 'Question not found'], 404);
            }

            $question->student_question = $item['student_question'];
            $question->save();

            $updatedQuestions[] = $question;
        }

        return response()->json($updatedQuestions);
    }



    public function destroy(string $id)
    {
        $question = StudentQuestion::findOrFail($id);
        $question->delete();
        return response()->json(['message' => 'Question deleted successfully']);
    }
}
