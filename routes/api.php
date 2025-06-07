<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Category
Route::get('get-categories', [CategoryController::class, 'index']);
Route::post('create-category', [CategoryController::class, 'store']);
Route::put('update-category/{id}', [CategoryController::class, 'update']);
Route::delete('delete-category/{id}', [CategoryController::class, 'destroy']);

//Course
Route::get('get-courses', [CourseController::class, 'index']);
Route::post('create-course', [CourseController::class, 'store']);
Route::put('update-course/{id}', [CourseController::class, 'update']);
Route::delete('delete-course/{id}', [CourseController::class, 'destroy']);
