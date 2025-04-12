<?php

use App\Mail\TaskPosted;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

// Ruta principală - redirecționează în funcție de autentificare
Route::get("/", function () {
    if (Auth::check()) {
        return redirect('/master');
    }
    return view("home");
});

// Ruta pentru master page
Route::get('/master', function () {
    if (!Auth::check()) {
        return redirect('/');
    }
    return view('master', [
        'tasks' => Auth::user()->tasks()->orderBy('deadline', 'asc')->get()
    ]);
})->middleware('auth');

Route::get('/home', function () {
    return view("home");
});

Route::get('/contact', function() {
    return view('contact');
});

// Rute pentru task-uri
Route::get('/create', [TaskController::class, 'create'])->middleware('auth');
Route::post('/tasks', [TaskController::class, 'store'])->middleware('auth');
Route::get('/task/{id}/edit', [TaskController::class, 'edit'])->middleware('auth');
Route::patch('/task/{id}', [TaskController::class, 'update']);
Route::delete('/task/{id}', [TaskController::class, 'destroy'])->middleware('auth');

// Rute de autentificare
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);

Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');