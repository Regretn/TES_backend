<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdminQuestionCollection;
use App\Http\Resources\AdminQuestionResource;
use Illuminate\Http\Request;
use App\Models\AdminQuestion;

class AdminQuestionController extends Controller
{
    public function index()
    {
        $questions = AdminQuestion::all();
        return new AdminQuestionCollection($questions);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'admin_question' => 'required|string|max:255',
        ]);

        $question = AdminQuestion::create($validatedData);
        return new AdminQuestionResource($question);
    }

    public function show(string $id)
    {
        $question = AdminQuestion::findOrFail($id);
        return new AdminQuestionResource($question);
    }

    public function update(Request $request)
    {
        $request->validate([
            'questions' => 'required|array',
            'questions.*.id' => 'required|exists:admin_questions,id',
            'questions.*.admin_question' => 'required|string|max:255',
        ]);

        $updatedQuestions = [];

        foreach ($request->questions as $item) {
            $question = AdminQuestion::find($item['id']);

            if (!$question) {
                return response()->json(['message' => 'Question not found'], 404);
            }

            $question->admin_question = $item['admin_question'];
            $question->save();

            $updatedQuestions[] = $question;
        }

        return response()->json($updatedQuestions);
    }

    public function destroy(string $id)
    {
        $question = AdminQuestion::findOrFail($id);
        $question->delete();
        return response()->json(['message' => 'Question deleted successfully']);
    }
}
