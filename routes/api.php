<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\AuthController;

// ------------------
// Rutas públicas
// ------------------

// Categorías
Route::get('get-categories', [CategoryController::class, 'index']);
Route::post('create-category', [CategoryController::class, 'store']);
Route::put('update-category/{id}', [CategoryController::class, 'update']);
Route::delete('delete-category/{id}', [CategoryController::class, 'destroy']);

// Cursos
Route::get('get-courses', [CourseController::class, 'index']);
Route::post('create-course', [CourseController::class, 'store']);
Route::put('update-course/{id}', [CourseController::class, 'update']);
Route::delete('delete-course/{id}', [CourseController::class, 'destroy']);

// Inscripciones (Enrollments)
Route::get('get-enrollments', [EnrollmentController::class, 'index']);
Route::post('create-enrollment', [EnrollmentController::class, 'store']);
Route::put('update-enrollment/{id}', [EnrollmentController::class, 'update']);
Route::delete('delete-enrollment/{id}', [EnrollmentController::class, 'destroy']);

// Evaluaciones
Route::get('get-evaluations', [EvaluationController::class, 'index']);
Route::post('create-evaluation', [EvaluationController::class, 'store']);
Route::put('update-evaluation/{id}', [EvaluationController::class, 'update']);
Route::delete('delete-evaluation/{id}', [EvaluationController::class, 'destroy']);

// Autenticación
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// ------------------
// Rutas protegidas por Sanctum
// ------------------
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
