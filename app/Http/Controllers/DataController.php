<?php

namespace App\Http\Controllers;

use App\Http\Resources\EvaluationResource;
use Illuminate\Http\Request;
use App\Models\Evaluation;

class DataController extends Controller
{
    public function index()
    {
    }
    public function show($id)
    {
        // $evaluation = Evaluation::all()->where('id', '=', $id)->first();
        // return new EvaluationResource($evaluation);
        $q1 = Evaluation::where('user_id', '=', $id)->sum('q1');
        $q2 = Evaluation::where('user_id', '=', $id)->sum('q2');
        $q3 = Evaluation::where('user_id', '=', $id)->sum('q3');
        $q4 = Evaluation::where('user_id', '=', $id)->sum('q4');
        $q5 = Evaluation::where('user_id', '=', $id)->sum('q5');
        $q6 = Evaluation::where('user_id', '=', $id)->sum('q6');
        $q7 = Evaluation::where('user_id', '=', $id)->sum('q7');
        $q8 = Evaluation::where('user_id', '=', $id)->sum('q8');
        $q9 = Evaluation::where('user_id', '=', $id)->sum('q9');
        $q10 = Evaluation::where('user_id', '=', $id)->sum('q10');
        $count = Evaluation::where('user_id', '=', $id)->count('total');


        $x = $q1 + $q2 + $q3 + $q4 + $q5 + $q6 + $q7 + $q8 + $q9 + $q10;
        $total = $count * 100;
        $percentage = ($x * 100) / $total;
        return new EvaluationResource($percentage);
    }
}
