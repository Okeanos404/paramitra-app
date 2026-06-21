<?php

namespace App\Http\Controllers\Customer;

use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CustomerInvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::whereHas('pesanan', function ($query) {
            $query->where('user_id', Auth::id());
        })->with('pesanan')->paginate(10);

        return view('customer.invoices.index', compact('invoices'));
    }

    public function show(Invoice $invoice)
    {
        if ($invoice->pesanan->user_id !== Auth::id()) {
            abort(403);
        }

        $invoice->load(['pesanan.user', 'pesanan.detailPesanan.produk']);
        return view('customer.invoices.show', compact('invoice'));
    }

    public function pdf(Invoice $invoice)
    {
        if ($invoice->pesanan->user_id !== Auth::id()) {
            abort(403);
        }

        $invoice->load(['pesanan.user', 'pesanan.detailPesanan.produk']);
        return view('customer.invoices.show', compact('invoice'));
    }
}
