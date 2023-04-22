<?php

namespace App\Http\Controllers;

use App\Http\Resources\EvaluationCollection;
use App\Http\Resources\EvaluationResource;
use Illuminate\Http\Request;
use App\Models\Evaluation;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
    public function index()
    {
        return new EvaluationCollection(Evaluation::all());
    }
    public function show(Request $request, $id)
    {
        $evaluations = Evaluation::where('teacher_id', '=', $id);

        if ($request->has('year')) {
            $year = $request->input('year');
            $evaluations->whereYear('created_at', '=', $year);
        } else {
            $evaluations->whereYear('created_at', '=', date('Y'));
        }

        $evaluations = $evaluations->get();
        return EvaluationResource::collection($evaluations);
    }


    // public function show(Request $request, $id)
    // {

    //     $evaluations = Evaluation::where('teacher_id', '=', $id);

    //     if ($request->has('year')) {
    //         $year = $request->input('year');
    //         $evaluations->whereYear('created_at', '=', $year);
    //     } else {
    //         $evaluations->whereYear('created_at', '=', date('Y'));
    //     }

    //     $evaluations = $evaluations->get();
    //     return EvaluationResource::collection($evaluations);
    // }
    public function store($id, Request $request)
    {
        $user_eval = new Evaluation;
        $id = Auth::user()->id;
        $role = Auth::user()->role_id;

        $user_eval->q1 = $request->q1;
        $user_eval->q2 = $request->q2;
        $user_eval->q3 = $request->q3;
        $user_eval->q4 = $request->q4;
        $user_eval->q5 = $request->q5;
        $user_eval->q6 = $request->q6;
        $user_eval->q7 = $request->q7;
        $user_eval->q8 = $request->q8;
        $user_eval->q9 = $request->q9;
        $user_eval->q10 = $request->q10;
        $user_eval->q11 = $request->q11;
        $user_eval->q12 = $request->q12;
        $user_eval->q13 = $request->q13;
        $user_eval->q14 = $request->q14;
        $user_eval->q15 = $request->q15;
        $user_eval->q16 = $request->q16;
        $user_eval->q17 = $request->q17;
        $user_eval->q18 = $request->q18;
        $user_eval->q19 = $request->q19;
        $user_eval->q20 = $request->q20;
        $user_eval->comment = $request->comment;
        $user_eval->total_score = $request->totalStore;
        $user_eval->user_id = $id;
        $user_eval->user_type = $role;

        if ($user_eval->save()) {
            return response()->json(['message' => 'Successfully Stored'])->setStatusCode(200);
        }
        return response()->json(['message' => 'Successfully Stored'])->setStatusCode(400);
    }
    public function destroy($id)
    {
        $evaluation = Evaluation::all()->where('id', '=', $id)->first();
        if ($evaluation->delete()) {
            return response()->json(['message' => 'successfully deleted'])->setStatusCode(200);
        }
        return response()->json(['message' => 'Error, cannot delete'])->setStatusCode(400);
    }
}
