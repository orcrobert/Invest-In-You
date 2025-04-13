<?php

use App\Mail\TaskPosted;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\AIController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

// Ruta principală - redirecționează în funcție de autentificare
Route::get("/", function () {
    if (Auth::check()) {
        return redirect('/tasks');
    }
    return view("home");
});


Route::get('/home', function () {
    return view("home");
});

Route::get('/contact', function() {
    return view('contact');
});

// Rute pentru task-uri
Route::get('/create', [TaskController::class, 'create'])->middleware('auth');
Route::get('/tasks', [TaskController::class, 'index'])->middleware('auth')->name('tasks.index');
Route::post('/tasks', [TaskController::class, 'store'])->middleware('auth');
Route::get('/task/{id}/edit', [TaskController::class, 'edit'])->middleware('auth');
Route::patch('/task/{id}', [TaskController::class, 'update'])->middleware('auth');
Route::delete('/task/{id}', [TaskController::class, 'destroy'])->middleware('auth');
Route::patch('/task/{id}/complete', [TaskController::class, 'complete'])->middleware('auth');

// Rute de autentificare
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);

Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');

// Rute pentru AI
Route::post('/ai/response', [AIController::class, 'getAIResponse'])->middleware('auth');

use App\Http\Controllers\PaymentController;

Route::middleware(['auth'])->group(function () {
    Route::get('/deposit', [PaymentController::class, 'depositForm'])->name('payment.deposit.form');
    Route::post('/deposit/checkout', [PaymentController::class, 'createCheckoutSession'])->name('payment.checkout');
    Route::get('/deposit/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('/deposit/cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');
});