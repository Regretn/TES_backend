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
    public function update(Request $request, string $id)
    {
        $question = AdminQuestion::findOrFail($id);
        $question->admin_question = (string) $request->admin_question;

        if ($question->save()) {
            return response()->json(['message' => 'Successfully updated'], 200);
        }

        return response()->json(['message' => 'Error, cannot update question'], 400);
    }


    public function destroy(string $id)
    {
        $question = AdminQuestion::findOrFail($id);
        $question->delete();
        return response()->json(['message' => 'Question deleted successfully']);
    }
}
