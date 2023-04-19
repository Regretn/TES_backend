<?php

namespace App\Http\Controllers;

use App\Http\Resources\EvaluationResource;
use Illuminate\Http\Request;
use App\Models\Evaluation;

class CriteriaDataController extends Controller
{

    public function criteria1($id)
    {

        $q1 = Evaluation::where('user_id', '=', $id)->sum('q1'); //question number 1
        $count1 = Evaluation::where('user_id', '=', $id)->count('q1');

        $q2 = Evaluation::where('user_id', '=', $id)->sum('q2');
        $count2 = Evaluation::where('user_id', '=', $id)->count('q2');

        $q3 = Evaluation::where('user_id', '=', $id)->sum('q3');
        $count3 = Evaluation::where('user_id', '=', $id)->count('q3');

        $q4 = Evaluation::where('user_id', '=', $id)->sum('q4');
        $count4 = Evaluation::where('user_id', '=', $id)->count('q4');

        $q5 = Evaluation::where('user_id', '=', $id)->sum('q5');
        $count5 = Evaluation::where('user_id', '=', $id)->count('q5');

        $x = $q1 + $q2 + $q3 + $q4 + $q5;
        $total = $count1 +  $count2 + $count3 + $count4 + $count5 * 100;
        $percentage = ($x * 100) / $total;
        return new EvaluationResource($percentage);
    }
    public function criteria2($id)
    {

        $q6 = Evaluation::where('user_id', '=', $id)->sum('q6'); //question number 1
        $count6 = Evaluation::where('user_id', '=', $id)->count('q6');

        $q7 = Evaluation::where('user_id', '=', $id)->sum('q7');
        $count7 = Evaluation::where('user_id', '=', $id)->count('q7');

        $q8 = Evaluation::where('user_id', '=', $id)->sum('q8');
        $count8 = Evaluation::where('user_id', '=', $id)->count('q8');

        $q9 = Evaluation::where('user_id', '=', $id)->sum('q9');
        $count9 = Evaluation::where('user_id', '=', $id)->count('q9');

        $q10 = Evaluation::where('user_id', '=', $id)->sum('q10');
        $count10 = Evaluation::where('user_id', '=', $id)->count('q10');






        $x = $q6 + $q7 + $q8 + $q9 + $q10;
        $total = $count6 +  $count7 + $count8 + $count9 + $count10 * 100;
        $percentage = ($x * 100) / $total;
        return new EvaluationResource($percentage);
    }
    public function criteria3($id)
    {

        $q11 = Evaluation::where('user_id', '=', $id)->sum('q11'); //question number 1
        $count11 = Evaluation::where('user_id', '=', $id)->count('q11');

        $q12 = Evaluation::where('user_id', '=', $id)->sum('q12');
        $count12 = Evaluation::where('user_id', '=', $id)->count('q12');

        $q13 = Evaluation::where('user_id', '=', $id)->sum('1q3');
        $count13 = Evaluation::where('user_id', '=', $id)->count('q13');

        $q14 = Evaluation::where('user_id', '=', $id)->sum('q14');
        $count14 = Evaluation::where('user_id', '=', $id)->count('q14');

        $q15 = Evaluation::where('user_id', '=', $id)->sum('q15');
        $count15 = Evaluation::where('user_id', '=', $id)->count('q15');






        $x = $q11 + $q12 + $q13 + $q14 + $q15;
        $total = $count11 +  $count12 + $count13 + $count14 + $count15 * 100;
        $percentage = ($x * 100) / $total;
        return new EvaluationResource($percentage);
    }
    public function criteria4($id)
    {

        $q16 = Evaluation::where('user_id', '=', $id)->sum('q16'); //question number 1
        $count16 = Evaluation::where('user_id', '=', $id)->count('q16');

        $q17 = Evaluation::where('user_id', '=', $id)->sum('q17');
        $count17 = Evaluation::where('user_id', '=', $id)->count('q17');

        $q18 = Evaluation::where('user_id', '=', $id)->sum('q18');
        $count18 = Evaluation::where('user_id', '=', $id)->count('q18');

        $q19 = Evaluation::where('user_id', '=', $id)->sum('q19');
        $count19 = Evaluation::where('user_id', '=', $id)->count('q19');

        $q20 = Evaluation::where('user_id', '=', $id)->sum('q20');
        $count20 = Evaluation::where('user_id', '=', $id)->count('q20');






        $x = $q16 + $q17 + $q18 + $q19 + $q20;
        $total = $count16 +  $count17  + $count18 + $count19 + $count20 * 100;
        $percentage = ($x * 100) / $total;
        return new EvaluationResource($percentage);
    }
}
