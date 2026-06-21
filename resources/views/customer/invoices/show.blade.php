@extends('layouts.app')

@section('title', 'Detail Invoice')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <div class="flex items-center justify-between no-print">
        <a href="{{ route('customer.invoices.index') }}" class="flex items-center gap-2 text-slate-500 hover:text-blue-600 transition-colors font-bold text-sm">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Daftar
        </a>
        <button onclick="window.print()" class="px-6 py-2 bg-slate-900 text-white rounded-xl font-bold flex items-center gap-2 hover:bg-slate-800 transition-colors">
            <i data-lucide="printer" class="w-4 h-4"></i> Cetak / Download PDF
        </button>
    </div>

    <div class="bg-white rounded-[2.5rem] p-12 border border-slate-100 shadow-xl shadow-slate-200/10 relative overflow-hidden print:shadow-none print:border-none print:p-0 print:rounded-none">
        <!-- Decoration -->
        <div class="absolute -right-20 -top-20 w-64 h-64 bg-blue-50 rounded-full blur-3xl opacity-50 print:hidden"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start gap-8 border-b border-slate-100 pb-8 mb-8 print:border-black">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-blue-500/20 print:bg-white print:border print:border-black print:shadow-none">
                    <img src="{{ asset('images/logo.png') }}" class="w-10 h-10 object-contain invert brightness-0 print:invert-0 print:brightness-100" alt="Logo">
                </div>
                <div>
                    <h1 class="text-2xl font-black text-slate-800 print:text-black">INVOICE</h1>
                    <p class="text-sm font-bold text-blue-600 uppercase tracking-widest print:text-black">INV-{{ str_pad($invoice->id, 5, '0', STR_PAD_LEFT) }}</p>
                </div>
            </div>
            
            <div class="text-left md:text-right">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1 print:text-black">Status</p>
                @if($invoice->status == 'paid')
                    <span class="inline-block px-4 py-2 bg-emerald-50 text-emerald-600 border border-emerald-100 rounded-full text-xs font-black uppercase tracking-widest print:border-none print:p-0 print:text-black">Lunas</span>
                @else
                    <span class="inline-block px-4 py-2 bg-amber-50 text-amber-600 border border-amber-100 rounded-full text-xs font-black uppercase tracking-widest print:border-none print:p-0 print:text-black">Belum Lunas</span>
                @endif
            </div>
        </div>

        <div class="relative z-10 grid grid-cols-1 md:grid-cols-2 gap-12 mb-12">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 print:text-black">Ditagihkan Kepada:</p>
                <h3 class="text-lg font-bold text-slate-800 print:text-black">{{ $invoice->pesanan->user->name }}</h3>
                <p class="text-slate-500 text-sm mt-2 print:text-black">{{ $invoice->pesanan->user->email }}</p>
            </div>
            <div class="md:text-right">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 print:text-black">Informasi Transaksi:</p>
                <div class="space-y-2">
                    <p class="text-sm"><span class="text-slate-500 print:text-black">Tanggal:</span> <span class="font-bold text-slate-800 print:text-black">{{ $invoice->created_at->format('d F Y') }}</span></p>
                    <p class="text-sm"><span class="text-slate-500 print:text-black">No. Order:</span> <span class="font-bold text-slate-800 print:text-black">ORD-{{ str_pad($invoice->pesanan_id, 5, '0', STR_PAD_LEFT) }}</span></p>
                </div>
            </div>
        </div>

        <div class="relative z-10 bg-slate-50 rounded-2xl overflow-hidden mb-8 print:bg-white print:border print:border-black print:rounded-none">
            <table class="w-full text-left print:border-collapse">
                <thead>
                    <tr class="bg-slate-100/50 print:bg-white print:border-b print:border-black">
                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest print:text-black">Produk</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest text-center print:text-black">Qty</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest text-right print:text-black">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 print:divide-black">
                    @foreach($invoice->pesanan->detailPesanan as $detail)
                    <tr>
                        <td class="px-6 py-4">
                            <p class="font-bold text-slate-800 print:text-black">{{ $detail->produk->nama_produk }}</p>
                            <p class="text-xs text-slate-500 print:text-black">{{ $detail->produk->kategori }} (Sudarshan Chemical)</p>
                        </td>
                        <td class="px-6 py-4 text-center font-medium text-slate-600 print:text-black">{{ $detail->jumlah }} KG</td>
                        <td class="px-6 py-4 text-right font-bold text-slate-800 print:text-black">Rp{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-blue-600 text-white print:bg-white print:text-black print:border-t print:border-black">
                        <td colspan="2" class="px-6 py-4 text-right font-black uppercase tracking-widest text-sm">Total Tagihan</td>
                        <td class="px-6 py-4 text-right font-black text-xl">Rp{{ number_format($invoice->pesanan->total_harga, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="text-center text-slate-500 text-sm mt-12 pt-8 border-t border-slate-100 print:border-black print:text-black">
            Terima kasih telah mempercayakan kebutuhan bahan kimia Anda kepada PT Paramitra Praya Prawatya.<br>
            <span class="font-bold">Official Distributor of Sudarshan Chemical Industries Ltd.</span>
        </div>
    </div>
</div>

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .max-w-4xl, .max-w-4xl * {
            visibility: visible;
        }
        .max-w-4xl {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        .no-print {
            display: none !important;
        }
    }
</style>
@endsection
