<?php

use App\Http\Controllers\AdminEvalController;
use App\Http\Controllers\AdminQuestionController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\StudentLoginController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\QuestionDataController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CriteriaDataController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\DateController;
use App\Http\Controllers\StudentQuestionController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherPeerController;
use App\Http\Controllers\TeacherQuestionController;
use App\Models\AdminQuestion;
use App\Models\StudentQuestion;

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
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::post('/student_login', [StudentLoginController::class, 'register']);
Route::post('/student_logout', [StudentLoginController::class, 'logout']);


Route::group(['namespace' => "App\Http\Controllers",], function () {
    Route::apiResource('user', UserController::class);
    Route::apiResource('teacher', TeacherController::class);
    Route::apiResource('role', RoleController::class);
    Route::apiResource('criteria', CriteriaDataController::class);
    Route::apiResource('year', DateController::class);
    Route::apiResource('evaluation', EvaluationController::class);

    Route::apiResource('role', RoleController::class);
});
Route::apiResource('section', SectionController::class);
Route::apiResource('student', StudentController::class);
Route::apiResource('admin_eval', AdminEvalController::class);
Route::apiResource('peer_eval', TeacherPeerController::class);
Route::apiResource('dashboard', DashBoardController::class);
Route::apiResource('teacher_question', TeacherQuestionController::class);
Route::apiResource('admin_question', AdminQuestionController::class);
Route::apiResource('student_question', StudentQuestionController::class);
Route::apiResource('criteria', CriteriaController::class);
Route::post('/criteria/update', [CriteriaController::class, 'update']);
Route::post('/teacher_question/update', [TeacherQuestionController::class, 'update']);
Route::post('/admin_question/update', [AdminQuestionController::class, 'update']);
Route::post('/student_question/update', [StudentQuestionController::class, 'update']);






Route::middleware('auth')->group(function () {
    Route::get('/question_1/{id}', [QuestionDataController::class, 'getQuestionData']);
});
