<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    CategoryController,
    CourseController,
    EnrollmentController,
    EvaluationController
};

// ------------------
// Rutas públicas
// ------------------
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/get-courses', [CourseController::class, 'index']);
Route::get('/get-categories', [CategoryController::class, 'index']);

// ------------------
// Rutas protegidas por Sanctum
// ------------------
Route::middleware(['auth:sanctum'])->group(function () {

    // Rutas compartidas
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', fn(Request $request) => $request->user());
    Route::get('/user-with-role', [AuthController::class, 'getUserWithRole']);

    // Rutas solo para ADMIN
    Route::middleware('role:admin')->group(function () {
        //Listado general de usuarios con su rol
    Route::get('/users-list', [AuthController::class, 'listUsers']);
        // Categorías
        Route::post('/create-category', [CategoryController::class, 'store']);
        Route::put('/update-category/{id}', [CategoryController::class, 'update']);
        Route::delete('/delete-category/{id}', [CategoryController::class, 'destroy']);

        // Cursos
        Route::post('/create-course', [CourseController::class, 'store']);
        Route::put('/update-course/{id}', [CourseController::class, 'update']);
        Route::delete('/delete-course/{id}', [CourseController::class, 'destroy']);

        // Evaluaciones
        Route::get('/get-evaluations', [EvaluationController::class, 'index']);
        Route::post('/create-evaluation', [EvaluationController::class, 'store']);
        Route::put('/update-evaluation/{id}', [EvaluationController::class, 'update']);
        Route::delete('/delete-evaluation/{id}', [EvaluationController::class, 'destroy']);
    });

    // Rutas solo para STUDENT
    Route::middleware('role:student')->group(function () {
        // Inscripciones
        Route::get('/get-enrollments', [EnrollmentController::class, 'index']);
        Route::post('/create-enrollment', [EnrollmentController::class, 'store']);
        Route::put('/update-enrollment/{id}', [EnrollmentController::class, 'update']);
        Route::delete('/delete-enrollment/{id}', [EnrollmentController::class, 'destroy']);

        // Cursos disponibles al estudiante
        Route::get('/student/courses', [CourseController::class, 'listForStudent']);

        // Inscribirse a un curso
        Route::post('/student/enroll/{course}', [EnrollmentController::class, 'enroll']);
    });
});
