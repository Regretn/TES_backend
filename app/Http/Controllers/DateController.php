<?php

namespace App\Http\Controllers;

use App\Http\Resources\DateCollection;
use App\Models\Evaluation;
use Illuminate\Http\Request;

class DateController extends Controller
{
    public function index()
    {
        $years = Evaluation::selectRaw('YEAR(created_at) as year')
            ->orderBy('year')
            ->pluck('year')
            ->unique();

        return response()->json($years);
        return new DateCollection($years);
    }
}
