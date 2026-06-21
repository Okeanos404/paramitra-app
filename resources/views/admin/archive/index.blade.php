@extends('layouts.app')

@section('title', 'Arsip Laporan Finansial')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <h2 class="text-3xl font-black text-slate-800">Arsip <span class="text-indigo-600">Laporan Transaksi</span></h2>
    </div>

    <!-- Tabs -->
    <div class="flex gap-4 border-b border-slate-200">
        <a href="{{ route('arsip.index', ['type' => 'pemasukan']) }}" 
           class="px-6 py-4 font-bold text-sm transition-all border-b-2 {{ $type === 'pemasukan' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-slate-400 hover:text-slate-600' }}">
            <i data-lucide="trending-up" class="w-4 h-4 inline-block mr-2"></i> Pemasukan (Dari Pelanggan)
        </a>
        <a href="{{ route('arsip.index', ['type' => 'pengeluaran']) }}" 
           class="px-6 py-4 font-bold text-sm transition-all border-b-2 {{ $type === 'pengeluaran' ? 'border-rose-600 text-rose-600' : 'border-transparent text-slate-400 hover:text-slate-600' }}">
            <i data-lucide="trending-down" class="w-4 h-4 inline-block mr-2"></i> Pengeluaran (Ke Supplier)
        </a>
    </div>

    <!-- Filter -->
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/10">
        <form action="{{ route('arsip.index') }}" method="GET" class="flex flex-wrap items-end gap-4">
            <input type="hidden" name="type" value="{{ $type }}">
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Mulai Tanggal</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Sampai Tanggal</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600">
            </div>
            <div class="flex-1"></div>
            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-600/30">
                Filter Arsip
            </button>
            @if(request()->has('start_date'))
                <a href="{{ route('arsip.index', ['type' => $type]) }}" class="px-6 py-2 bg-slate-100 text-slate-600 rounded-xl font-bold hover:bg-slate-200 transition-colors">Reset</a>
            @endif
        </form>
    </div>

    <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/10">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/50">
                        @if($type === 'pemasukan')
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest rounded-l-2xl">No. Pesanan</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Pelanggan</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Tanggal Pesanan</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Waktu Diterima</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Nilai</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest rounded-r-2xl text-center">Status</th>
                        @else
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest rounded-l-2xl">No. Purchase Order</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Supplier</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Tanggal PO</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Pengeluaran</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest rounded-r-2xl text-center">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($archives as $archive)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        @if($type === 'pemasukan')
                            <td class="px-6 py-4 text-sm font-bold text-slate-800">
                                ORD-{{ str_pad($archive->id, 5, '0', STR_PAD_LEFT) }}
                                @if($archive->pengiriman)
                                    <br><span class="text-xs text-slate-500 font-normal">Resi: {{ $archive->pengiriman->no_resi }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-700">{{ $archive->user->name }}</p>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">
                                {{ $archive->tanggal_pesanan->format('d M Y H:i') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">
                                {{ optional(optional(optional($archive->pengiriman)->suratJalan)->waktu_penerimaan)->format('d M Y H:i') ?? '-' }}
                            </td>
                            <td class="px-6 py-4 font-black text-emerald-600">
                                + Rp{{ number_format($archive->total_harga, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 bg-indigo-50 text-indigo-600 border border-indigo-100 rounded-full text-[10px] font-bold uppercase tracking-widest">
                                    Selesai
                                </span>
                            </td>
                        @else
                            <td class="px-6 py-4 text-sm font-bold text-slate-800">
                                {{ $archive->po_number }}
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-indigo-700">{{ optional($archive->supplier)->nama_supplier ?? '-' }}</p>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">
                                {{ $archive->tanggal_po->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 font-black text-rose-600">
                                - Rp{{ number_format($archive->total_amount, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('purchase-orders.show', $archive->id) }}" class="px-4 py-2 bg-slate-100 text-slate-600 rounded-xl font-bold hover:bg-slate-200 transition-colors inline-block text-xs">
                                    Detail Arsip
                                </a>
                            </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-400">Belum ada arsip laporan untuk kategori ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-6">
            {{ $archives->appends(['type' => $type, 'start_date' => request('start_date'), 'end_date' => request('end_date')])->links() }}
        </div>
    </div>
</div>
@endsection
