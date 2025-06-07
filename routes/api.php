<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('get-categories', [CategoryController::class, 'index']);
//Route::post('create-category', [CategoryController::class, 'store']);
//Route::put('update-category/{id}', [CategoryController::class, 'update']);
//Route::delete('delete-category/{id}', [CategoryController::class, 'destroy']);
