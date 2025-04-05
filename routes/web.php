<?php

use Illuminate\Support\Facades\Route;
use App\Models\Task;

Route::get('/', function () {
    $tasks = Task::with('category')->get();

    return view('welcome', [
        'tasks' => $tasks,
    ]);
});

Route::get('/about', function() {
    return view('about');
});

Route::get('/contact', function() {
    return view('contact');
});