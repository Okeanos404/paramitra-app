<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\Pesanan;
use Carbon\Carbon;

class InvoiceService
{
    public function generateInvoice(Pesanan $pesanan, $daysUntilDue = 30): Invoice
    {
        $invoiceNumber = $this->generateInvoiceNumber();
        $dueDate = Carbon::now()->addDays($daysUntilDue);

        $invoice = Invoice::create([
            'pesanan_id' => $pesanan->id,
            'invoice_number' => $invoiceNumber,
            'issue_date' => now(),
            'due_date' => $dueDate,
            'total_amount' => $pesanan->total_harga,
            'status' => 'issued',
        ]);

        $pesanan->update(['invoice_number' => $invoiceNumber]);

        return $invoice;
    }

    public function generateInvoiceNumber(): string
    {
        $lastInvoice = Invoice::latest('id')->first();
        $number = $lastInvoice ? intval(substr($lastInvoice->invoice_number, -5)) + 1 : 1;
        return 'INV-' . date('Ymd') . '-' . str_pad($number, 5, '0', STR_PAD_LEFT);
    }

    public function markAsPaid(Invoice $invoice): bool
    {
        return $invoice->update(['status' => 'paid']);
    }

    public function checkOverdue(): void
    {
        Invoice::where('status', '!=', 'paid')
            ->where('due_date', '<', now())
            ->update(['status' => 'overdue']);
    }
}
