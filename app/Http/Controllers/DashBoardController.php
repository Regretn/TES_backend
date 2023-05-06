<?php

namespace App\Http\Controllers;

use App\Http\Resources\DashboardCollection;
use App\Models\Evaluation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $dashboard = Evaluation::whereYear('created_at', Carbon::now()->year)->get();
        return new DashboardCollection($dashboard);
    }
}
