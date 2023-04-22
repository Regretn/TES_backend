<?php

namespace App\Http\Controllers;

use App\Http\Resources\CriteriaCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Evaluation;

class CriteriaDataController extends Controller
{
    public function index()
    {
        return new CriteriaCollection(Evaluation::all());
    }
}
