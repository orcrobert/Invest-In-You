<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Transaction; // You'll need to create this model

class PaymentController extends Controller
{
    public function depositForm()
    {
        // Get user's transactions if you want to display refund options
        $transactions = Transaction::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('payment.deposit', compact('transactions'));
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
                    'currency' => 'ron',
                    'unit_amount' => $amount,
                    'product_data' => [
                        'name' => 'Deposit to Balance',
                    ],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('payment.cancel'),
            'customer_email' => Auth::user()->email,
        ]);

        // Store amount and checkout session ID for retrieval after payment
        session([
            'deposit_amount' => $request->input('amount'),
            'checkout_session_id' => $checkoutSession->id
        ]);

        return redirect()->away($checkoutSession->url);
    }

    public function paymentSuccess(Request $request)
    {
        $user = Auth::user();
        $amount = session('deposit_amount');
        $sessionId = $request->query('session_id');

        if (!$user || !$amount || !$sessionId) {
            return redirect('/tasks')->with('error', 'Missing payment information. Please try again.');
        }

        try {
            // Retrieve checkout session to get payment intent
            Stripe::setApiKey(config('services.stripe.secret'));
            $checkoutSession = Session::retrieve($sessionId);
            $paymentIntentId = $checkoutSession->payment_intent;

            // Update user balance
            $user->balance += $amount;
            $user->save();

            // Record transaction
            Transaction::create([
                'user_id' => $user->id,
                'amount' => $amount,
                'payment_intent_id' => $paymentIntentId,
                'status' => 'completed',
                'type' => 'deposit'
            ]);

            session()->forget(['deposit_amount', 'checkout_session_id']);
            return redirect('/tasks')->with('success', 'Funds added to your balance successfully!');
        } catch (\Exception $e) {
            return redirect('/tasks')->with('error', 'Error processing payment: ' . $e->getMessage());
        }
    }

    public function refundPayment(Request $request)
    {
        $request->validate([
            'payment_intent_id' => 'required|string',
            'amount' => 'required|numeric|min:0.01',
            'transaction_id' => 'required|exists:transactions,id'
        ]);

        $paymentIntentId = $request->input('payment_intent_id');
        $amount = $request->input('amount');
        $transactionId = $request->input('transaction_id');

        // Find the transaction
        $transaction = Transaction::find($transactionId);

        // Check if transaction belongs to current user
        if ($transaction->user_id !== Auth::id()) {
            return redirect('/tasks')->with('error', 'Unauthorized refund request');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            // Create a refund
            $refund = \Stripe\Refund::create([
                'payment_intent' => $paymentIntentId,
            ]);

            // Update user's balance
            $user = Auth::user();
            $user->balance -= $amount;
            $user->save();

            // Update transaction or create refund record
            $transaction->update(['status' => 'refunded']);

            // Create refund transaction
            Transaction::create([
                'user_id' => $user->id,
                'amount' => -$amount, // Negative amount for refund
                'payment_intent_id' => $paymentIntentId,
                'status' => 'completed',
                'type' => 'refund',
                'related_transaction_id' => $transactionId
            ]);

            return redirect('/tasks')->with('success', 'Refund processed successfully!');
        } catch (\Exception $e) {
            return redirect('/tasks')->with('error', 'Refund failed: ' . $e->getMessage());
        }
    }

    // Add this to PaymentController
    public function refundForm()
    {
        $user = Auth::user();

        return view('payment.refund', [
            'user' => $user
        ]);
    }

    public function processRefund(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'bank_account' => 'required|string|min:10',
            'reason' => 'required|string',
            'details' => 'nullable|string'
        ]);

        $user = Auth::user();
        $amount = $request->input('amount');

        // Check if user has sufficient balance
        if ($user->balance < $amount) {
            return back()->with('error', 'Suma solicitată depășește soldul disponibil în cont.');
        }

        try {
            // Update user balance
            $user->balance -= $amount;
            $user->save();

            // Create transaction record for the refund
            Transaction::create([
                'user_id' => $user->id,
                'amount' => -$amount, // Negative amount for refund
                'status' => 'pending',
                'type' => 'refund',
                'description' => 'Refund requested to bank account: ' . substr($request->input('bank_account'), -4),
                'metadata' => json_encode([
                    'bank_account' => $request->input('bank_account'),
                    'reason' => $request->input('reason'),
                    'details' => $request->input('details')
                ])
            ]);

            return redirect('/tasks')->with('success', 'Cererea de rambursare a fost înregistrată cu succes. Vei fi notificat când aceasta va fi procesată.');
        } catch (\Exception $e) {
            return back()->with('error', 'A apărut o eroare la procesarea cererii: ' . $e->getMessage());
        }
    }

    public function paymentCancel()
    {
        session()->forget(['deposit_amount', 'checkout_session_id']);
        return redirect('/')->with('error', 'Payment was cancelled.');
    }
}
