<?php

namespace App\Http\Controllers\Customer;

use App\Models\PaymentTransaction;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CustomerPaymentController extends Controller
{
    public function index()
    {
        $payments = PaymentTransaction::whereHas('pesanan', function ($query) {
            $query->where('user_id', Auth::id());
        })->with('pesanan', 'paymentMethod')->paginate(10);

        $pendingPayments = PaymentTransaction::whereHas('pesanan', function ($query) {
            $query->where('user_id', Auth::id());
        })->where('status', 'pending')->count();

        return view('customer.payments.index', compact('payments', 'pendingPayments'));
    }

    public function show(PaymentTransaction $payment)
    {
        if ($payment->pesanan->user_id !== Auth::id()) {
            abort(403);
        }

        $payment->load(['pesanan', 'paymentMethod']);
        return view('customer.payments.show', compact('payment'));
    }
}
