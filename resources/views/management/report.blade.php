@extends('layouts.app')

@section('title', 'Laporan Finansial Gabungan')

@section('content')
<div class="space-y-6">
    <!-- Filter Section (Hide on Print) -->
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm print:hidden">
        <form action="{{ route('manajemen.report') }}" method="GET" class="flex flex-col md:flex-row items-end gap-4">
            <div class="flex-1">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl outline-none">
            </div>
            <div class="flex-1">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Selesai</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl outline-none">
            </div>
            <button type="submit" class="bg-blue-600 text-white px-8 py-2 rounded-xl font-bold hover:bg-blue-700 transition-all shadow-lg shadow-blue-600/30">Filter</button>
            <button type="button" onclick="window.print()" class="bg-slate-800 text-white px-8 py-2 rounded-xl font-bold hover:bg-slate-900 transition-all flex items-center gap-2">
                <i data-lucide="printer" class="w-5 h-5"></i>
                Cetak PDF
            </button>
        </form>
    </div>

    <!-- Report Document -->
    <div class="bg-white p-12 rounded-3xl border border-slate-100 shadow-sm min-h-screen print:shadow-none print:border-none print:p-0 print:m-0">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">LAPORAN FINANSIAL GABUNGAN</h1>
            <p class="text-slate-500 font-bold uppercase tracking-widest mt-2">PT Paramitra Praya Prawatya</p>
            <div class="mt-4 border-b-4 border-slate-800 w-24 mx-auto rounded-full"></div>
        </div>

        <div class="mb-8 text-sm text-slate-600 flex justify-between font-medium">
            <div>
                <p>Dicetak pada: <span class="font-bold text-slate-800">{{ now()->format('d/m/Y H:i') }}</span></p>
            </div>
            @if(request('start_date'))
            <div>
                <p>Periode: <span class="font-bold text-slate-800">{{ \Carbon\Carbon::parse(request('start_date'))->format('d/m/Y') }} s/d {{ \Carbon\Carbon::parse(request('end_date'))->format('d/m/Y') }}</span></p>
            </div>
            @endif
        </div>

        @php 
            $grand_total_sales = 0; 
            $grand_total_purchases = 0;
        @endphp

        <!-- TABEL 1: PEMASUKAN (PENJUALAN) -->
        <div class="mb-12">
            <h2 class="text-lg font-black text-emerald-700 mb-4 uppercase tracking-widest flex items-center gap-2">
                <i data-lucide="arrow-down-left" class="w-5 h-5"></i> I. Laporan Pemasukan (Penjualan)
            </h2>
            <table class="w-full text-left border-collapse border border-slate-200">
                <thead>
                    <tr class="bg-slate-50 print:bg-slate-100">
                        <th class="border border-slate-200 px-4 py-3 text-sm font-bold text-slate-800 w-12 text-center">No</th>
                        <th class="border border-slate-200 px-4 py-3 text-sm font-bold text-slate-800 w-32">Tanggal</th>
                        <th class="border border-slate-200 px-4 py-3 text-sm font-bold text-slate-800">Pelanggan</th>
                        <th class="border border-slate-200 px-4 py-3 text-sm font-bold text-slate-800">Detail Produk</th>
                        <th class="border border-slate-200 px-4 py-3 text-sm font-bold text-slate-800 text-right w-48">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sales as $index => $sale)
                    @php $grand_total_sales += $sale->total_harga; @endphp
                    <tr>
                        <td class="border border-slate-200 px-4 py-3 text-sm text-center">{{ $index + 1 }}</td>
                        <td class="border border-slate-200 px-4 py-3 text-sm">{{ $sale->tanggal_pesanan->format('d/m/Y') }}</td>
                        <td class="border border-slate-200 px-4 py-3 text-sm font-bold text-slate-700">{{ $sale->user->name }}</td>
                        <td class="border border-slate-200 px-4 py-3 text-sm text-slate-600">
                            <ul class="list-disc list-inside">
                            @foreach($sale->detailPesanan as $detail)
                                <li>{{ $detail->produk->nama_produk }} ({{ $detail->jumlah }}x)</li>
                            @endforeach
                            </ul>
                        </td>
                        <td class="border border-slate-200 px-4 py-3 text-sm text-right font-black text-emerald-600">+ Rp {{ number_format($sale->total_harga, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="border border-slate-200 px-4 py-8 text-sm text-center text-slate-400 italic">Tidak ada transaksi pemasukan pada periode ini.</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="bg-emerald-50">
                        <td colspan="4" class="border border-emerald-200 px-4 py-4 text-right font-black text-emerald-900">SUBTOTAL PEMASUKAN</td>
                        <td class="border border-emerald-200 px-4 py-4 text-right font-black text-emerald-700 text-lg">+ Rp {{ number_format($grand_total_sales, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- TABEL 2: PENGELUARAN (PEMBELIAN) -->
        <div class="mb-12">
            <h2 class="text-lg font-black text-rose-700 mb-4 uppercase tracking-widest flex items-center gap-2">
                <i data-lucide="arrow-up-right" class="w-5 h-5"></i> II. Laporan Pengeluaran (Pembelian)
            </h2>
            <table class="w-full text-left border-collapse border border-slate-200">
                <thead>
                    <tr class="bg-slate-50 print:bg-slate-100">
                        <th class="border border-slate-200 px-4 py-3 text-sm font-bold text-slate-800 w-12 text-center">No</th>
                        <th class="border border-slate-200 px-4 py-3 text-sm font-bold text-slate-800 w-32">Tanggal</th>
                        <th class="border border-slate-200 px-4 py-3 text-sm font-bold text-slate-800">Supplier</th>
                        <th class="border border-slate-200 px-4 py-3 text-sm font-bold text-slate-800">Detail Pembelian</th>
                        <th class="border border-slate-200 px-4 py-3 text-sm font-bold text-slate-800 text-right w-48">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($purchases as $index => $purchase)
                    @php $grand_total_purchases += $purchase->total_amount; @endphp
                    <tr>
                        <td class="border border-slate-200 px-4 py-3 text-sm text-center">{{ $index + 1 }}</td>
                        <td class="border border-slate-200 px-4 py-3 text-sm">{{ $purchase->tanggal_po->format('d/m/Y') }}</td>
                        <td class="border border-slate-200 px-4 py-3 text-sm font-bold text-slate-700">{{ optional($purchase->supplier)->nama_supplier ?? 'Unknown Supplier' }}</td>
                        <td class="border border-slate-200 px-4 py-3 text-sm text-slate-600">
                            <ul class="list-disc list-inside">
                            @foreach($purchase->items as $item)
                                <li>{{ optional($item->produk)->nama_produk ?? 'Unknown Product' }} ({{ $item->jumlah }}x)</li>
                            @endforeach
                            </ul>
                        </td>
                        <td class="border border-slate-200 px-4 py-3 text-sm text-right font-black text-rose-600">- Rp {{ number_format($purchase->total_amount, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="border border-slate-200 px-4 py-8 text-sm text-center text-slate-400 italic">Tidak ada transaksi pengeluaran pada periode ini.</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="bg-rose-50">
                        <td colspan="4" class="border border-rose-200 px-4 py-4 text-right font-black text-rose-900">SUBTOTAL PENGELUARAN</td>
                        <td class="border border-rose-200 px-4 py-4 text-right font-black text-rose-700 text-lg">- Rp {{ number_format($grand_total_purchases, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- RINGKASAN LABA/RUGI BERSIH -->
        @php
            $net_profit = $grand_total_sales - $grand_total_purchases;
            $is_profit = $net_profit >= 0;
            $bg_color = $is_profit ? 'bg-indigo-600' : 'bg-rose-600';
            $text_color = 'text-white';
            $border_color = $is_profit ? 'border-indigo-800' : 'border-rose-800';
        @endphp
        <div class="mt-8 rounded-2xl border-2 {{ $border_color }} overflow-hidden print:border-4 print:border-slate-800">
            <div class="{{ $bg_color }} px-8 py-6 flex items-center justify-between print:bg-transparent print:border-b-4 print:border-slate-800">
                <div>
                    <h3 class="text-2xl font-black {{ $text_color }} uppercase tracking-widest print-text-black">LABA / RUGI BERSIH</h3>
                    <p class="{{ $text_color }} opacity-80 text-sm mt-1 print-text-black">Total Pemasukan dikurangi Total Pengeluaran</p>
                </div>
                <div class="text-right">
                    <p class="text-4xl font-black {{ $text_color }} tracking-tight print-text-black">
                        {{ $is_profit ? '+' : '-' }} Rp {{ number_format(abs($net_profit), 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-24 flex justify-end">
            <div class="text-center w-64">
                <p class="text-slate-600 mb-24 font-medium">Disahkan Oleh,</p>
                <p class="font-black border-b-2 border-slate-800 pb-2 text-slate-800 text-lg uppercase tracking-wide">{{ Auth::user()->name }}</p>
                <p class="text-sm font-bold text-slate-500 mt-2 uppercase tracking-widest">{{ Auth::user()->role }}</p>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        @page {
            size: A4 portrait;
            margin: 1.5cm;
        }
        body { 
            background: white !important; 
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        aside, header, button, .print\:hidden { display: none !important; }
        main { margin-left: 0 !important; padding: 0 !important; }
        
        /* Ensure tables don't break awkwardly */
        table { page-break-inside: auto; }
        tr { page-break-inside: avoid; page-break-after: auto; }
        thead { display: table-header-group; }
        tfoot { display: table-footer-group; }
        
        /* Force background colors to print */
        .bg-emerald-50 { background-color: #ecfdf5 !important; }
        .bg-rose-50 { background-color: #fff1f2 !important; }
        .bg-indigo-600 { background-color: #4f46e5 !important; }
        .print-text-black { color: #0f172a !important; }
    }
</style>
@endsection
