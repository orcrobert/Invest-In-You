<?php

use Illuminate\Support\Facades\Route;
use App\Models\Task;
use App\Http\Controllers;
use App\Http\Controllers\TaskController;

Route::get("/", function () {
    return view("home");
});

Route::get('/about', function() {
    return view('about');
});

Route::get('/contact', function() {
    return view('contact');
});

Route::get('/tasks', [TaskController::class, 'index']);

Route::get('/task/{id}', [TaskController::class, 'show']);

Route::get('/create', [TaskController::class, 'create']);

Route::post('/tasks', [TaskController::class, 'store']);

Route::get('/task/{id}/edit', [TaskController::class, 'edit']);

Route::patch('/task/{id}', [TaskController::class, 'update']);

Route::delete('/task/{id}', [TaskController::class, 'destroy']);