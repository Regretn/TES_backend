<?php

namespace App\Http\Controllers;

use App\Http\Resources\EvaluationCollection;
use App\Http\Resources\EvaluationResource;
use Illuminate\Http\Request;
use App\Models\Evaluation;
use Illuminate\Support\Facades\Validator;
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

        if ($request->has('user_type')) {
            $role = $request->input('user_type');
            $evaluations->where('user_type', '=', $role);
        } else {
            $evaluations->whereIn('user_type', [1, 2, 3]);
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'q1' => 'required',
            'q2' => 'required',
            'q3' => 'required',
            'q4' => 'required',
            'q5' => 'required',
            'q6' => 'required',
            'q7' => 'required',
            'q8' => 'required',
            'q9' => 'required',
            'q10' => 'required',
            'q11' => 'required',
            'q12' => 'required',
            'q13' => 'required',
            'q14' => 'required',
            'q15' => 'required',
            'q16' => 'required',
            'q17' => 'required',
            'q18' => 'required',
            'q19' => 'required',
            'q20' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Check if all fields are filled
        if (
            empty($request->q1) || empty($request->q2) || empty($request->q3) || empty($request->q4) || empty($request->q5) ||
            empty($request->q6) || empty($request->q7) || empty($request->q8) || empty($request->q9) || empty($request->q10) ||
            empty($request->q11) || empty($request->q12) || empty($request->q13) || empty($request->q14) || empty($request->q15) ||
            empty($request->q16) || empty($request->q17) || empty($request->q18) || empty($request->q19) || empty($request->q20)
        ) {
            return response()->json(['message' => 'Please fill all fields'], 422);
        }


        $user_eval = new Evaluation;

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
        $user_eval->teacher_id = $request->teacher_id;
        $user_eval->student_id = $request->student_id;
        $user_eval->user_id = $request->user_id;
        $user_eval->user_type = $request->user_type;
        $user_eval->total_score = $request->q1 + $request->q2 + $request->q3 + $request->q4 + $request->q5 + $request->q6 + $request->q7 + $request->q8 + $request->q9 + $request->q10 + $request->q11 + $request->q12 + $request->q13 + $request->q14 + $request->q15 + $request->q16 + $request->q17 + $request->q18 + $request->q19 + $request->q20;
        $user_eval->comment = $request->comment ? $request->comment : "This evaluator didn't leave a comment";


        if ($user_eval->save()) {
            return response()->json(['message' => 'Successfully Stored'])->setStatusCode(200);
        }
        return response()->json(['message' => 'Failed to Store'])->setStatusCode(400);
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
