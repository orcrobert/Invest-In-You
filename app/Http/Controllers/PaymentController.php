<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PaymentController extends Controller
{
    public function depositForm()
    {
        return view('payment.deposit');
    }

    public function createCheckoutSession(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        Stripe::setApiKey(config('services.stripe.secret'));

        $amount = $request->input('amount') * 100;

        $checkoutSession = Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $amount,
                    'product_data' => [
                        'name' => 'Deposit to Balance',
                    ],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success'),
            'cancel_url' => route('payment.cancel'),
            'customer_email' => Auth::user()->email,
        ]);

        $amount = $request->input('amount');
        session(['deposit_amount' => $amount]);

        return redirect()->away($checkoutSession->url);
    }

    public function paymentSuccess()
    {
        $user = Auth::user();
        $amount = session('deposit_amount');

        if ($user && $amount !== null) {
            $user->balance += $amount;
            $user->save();
            session()->forget('deposit_amount');

            return redirect('/tasks')->with('success', 'Funds added to your balance successfully!');
        } else {
            return redirect('/tasks')->with('error', 'Failed to add funds. Please try again.');
        }
    }

    public function paymentCancel()
    {
        return redirect('/')->with('error', 'Payment was cancelled.');
    }
}
