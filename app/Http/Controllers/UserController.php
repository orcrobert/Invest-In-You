<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function add_balance(Request $request) {
        $user = Auth::user();
        $user->balance += $request->amount;

        return redirect('/tasks');
    }
}
