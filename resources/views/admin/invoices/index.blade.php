@extends('layouts.app')

@section('title', 'Manajemen Invoice')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Manajemen Invoice</h2>
            <p class="text-slate-500 text-sm">Kelola semua tagihan pelanggan dan pantau status pembayaran.</p>
        </div>
    </div>

    <!-- Invoices Table -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="px-6 py-4 text-sm font-semibold text-slate-600">No. Invoice</th>
                        <th class="px-6 py-4 text-sm font-semibold text-slate-600">ID Pesanan</th>
                        <th class="px-6 py-4 text-sm font-semibold text-slate-600">Pelanggan</th>
                        <th class="px-6 py-4 text-sm font-semibold text-slate-600">Total Harga</th>
                        <th class="px-6 py-4 text-sm font-semibold text-slate-600">Status</th>
                        <th class="px-6 py-4 text-sm font-semibold text-slate-600">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($invoices as $invoice)
                    <tr class="hover:bg-slate-50 transition-colors group">
                        <td class="px-6 py-4 font-bold text-slate-800">
                            {{ $invoice->invoice_number }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-mono text-xs bg-slate-100 px-2 py-1 rounded text-slate-600">#ORD-{{ str_pad($invoice->pesanan_id, 5, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-bold text-slate-800">{{ $invoice->pesanan->user->name }}</p>
                        </td>
                        <td class="px-6 py-4 font-semibold text-slate-800">Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            @if($invoice->status == 'paid')
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-600 border border-emerald-100 rounded-full text-[10px] font-bold uppercase tracking-widest">Lunas</span>
                            @else
                                <span class="px-3 py-1 bg-amber-50 text-amber-600 border border-amber-100 rounded-full text-[10px] font-bold uppercase tracking-widest">Belum Lunas</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('invoices.show', $invoice->id) }}" class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition-all" title="Lihat Resi">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                </a>
                                <a href="{{ route('invoices.pdf', $invoice->id) }}" target="_blank" class="p-2 bg-slate-50 text-slate-600 rounded-lg hover:bg-slate-800 hover:text-white transition-all" title="Download PDF">
                                    <i data-lucide="download" class="w-4 h-4"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-500">Belum ada invoice yang diterbitkan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($invoices->hasPages())
        <div class="px-6 py-4 border-t border-slate-100">
            {{ $invoices->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
