<?php

use Illuminate\Support\Facades\Route;
use App\Models\Task;


Route::get("/", function () {
    return view("home");
});

Route::get('/tasks', function () {
    $tasks = Task::with('category')->paginate(3);

    return view('task.index', [
        'tasks' => $tasks,
    ]);
});

Route::get('/task/{id}', function ($id) {
    $task = Task::find($id);
    return view('task.show', 
    ['task' => $task]);
});

Route::get('/about', function() {
    return view('about');
});

Route::get('/create', function () {
    return view('task.create');
});

Route::get('/contact', function() {
    return view('contact');
});