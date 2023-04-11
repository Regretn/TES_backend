<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:3,5');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth::sanctum');

Route::group(['namespace' => "App\Http\Controllers", 'middleware' => 'auth:sanctum'], function () {
    Route::apiResource('evaluation', EvaluationController::class);
    Route::apiResource('student', StudentController::class);
    Route::apiResource('user', UserController::class);
    Route::apiResource('role', RoleController::class);
    Route::apiResource('section', SectionController::class);
});