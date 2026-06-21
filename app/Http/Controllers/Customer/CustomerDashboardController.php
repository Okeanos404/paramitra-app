<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Invoice;
use App\Models\PaymentTransaction;
use App\Models\Pengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $orders = Pesanan::where('user_id', $userId)
            ->with(['detailPesanan.produk', 'pengiriman'])
            ->latest()
            ->get();

        $invoicesCount = Invoice::whereHas('pesanan', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->count();

        $pendingPaymentsCount = PaymentTransaction::whereHas('pesanan', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->where('status', 'pending')->count();

        $shipmentsCount = Pengiriman::whereHas('pesanan', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->count();
            
        return view('customer.dashboard', compact('orders', 'invoicesCount', 'pendingPaymentsCount', 'shipmentsCount'));
    }

    public function track(Pesanan $pesanan)
    {
        // Security check: ensure customer only sees their own order
        if ($pesanan->user_id !== Auth::id()) {
            abort(403);
        }

        $pesanan->load(['pengiriman.distribusi' => function($query) {
            $query->latest();
        }]);

        return view('customer.track', compact('pesanan'));
    }
}
