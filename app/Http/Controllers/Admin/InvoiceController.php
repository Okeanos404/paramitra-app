<?php

namespace App\Http\Controllers\Admin;

use App\Models\Invoice;
use App\Models\Pesanan;
use App\Services\InvoiceService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    protected $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    public function index()
    {
        $invoices = Invoice::with('pesanan.user')->paginate(15);
        return view('admin.invoices.index', compact('invoices'));
    }

    public function show(Invoice $invoice)
    {
        $invoice->load(['pesanan.user', 'pesanan.detailPesanan.produk']);
        return view('admin.invoices.show', compact('invoice'));
    }

    public function generate(Pesanan $pesanan)
    {
        if ($pesanan->invoice) {
            return redirect()->back()->with('error', 'Invoice already generated for this order');
        }

        $invoice = $this->invoiceService->generateInvoice($pesanan);
        return redirect()->route('invoices.show', $invoice)->with('success', 'Invoice generated successfully');
    }

    public function markAsPaid(Invoice $invoice)
    {
        $this->invoiceService->markAsPaid($invoice);
        return redirect()->back()->with('success', 'Invoice marked as paid');
    }

    public function pdf(Invoice $invoice)
    {
        $invoice->load(['pesanan.user', 'pesanan.detailPesanan.produk']);
        return view('admin.invoices.show', compact('invoice'));
    }
}
