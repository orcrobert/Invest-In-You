<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store() 
    {
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required',]
        ]);

        Auth::attempt($attributes);

        request()->session()->regenerate();
        return redirect('/tasks');
    }

    public function destroy() 
    {
        Auth::logout();
        return redirect('/');
    }
}
