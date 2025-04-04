<?php

use Illuminate\Support\Facades\Route;
use App\Models\Task;

Route::get('/', function () {
    // return view('welcome', [
    //     'eu' => 'robert',
    //     'tu' => 'mata',
    // ]);

    $tasks = Task::all();
    dd($tasks[0]->name);
});

Route::get('/about', function() {
    return view('about');
});

Route::get('/contact', function() {
    return view('contact');
});