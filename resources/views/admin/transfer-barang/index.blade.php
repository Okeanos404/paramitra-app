@extends('layouts.app')

@section('title', 'Transfer Barang antar Gudang')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <h2 class="text-3xl font-black text-slate-800">Transfer <span class="text-indigo-600">Barang</span></h2>
        <a href="/admin/transfer-barang/create" class="px-6 py-2 bg-indigo-600 text-white rounded-xl font-bold flex items-center gap-2 hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-600/30">
            <i data-lucide="arrow-right-left" class="w-5 h-5"></i> Buat Transfer Baru
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/10">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest rounded-l-2xl">No Transfer</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Gudang Asal</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Gudang Tujuan</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Tanggal</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest rounded-r-2xl text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($transfers as $transfer)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 font-bold text-slate-800">
                            {{ $transfer->no_transfer }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-slate-600">
                            {{ optional($transfer->dariGudang)->nama_gudang ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-slate-600">
                            {{ optional($transfer->keGudang)->nama_gudang ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-500">
                            {{ \Carbon\Carbon::parse($transfer->tanggal_transfer)->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($transfer->status === 'pending')
                                <span class="px-3 py-1 bg-amber-50 text-amber-600 border border-amber-100 rounded-full text-[10px] font-bold uppercase tracking-widest">Menunggu</span>
                            @elseif($transfer->status === 'approved')
                                <span class="px-3 py-1 bg-blue-50 text-blue-600 border border-blue-100 rounded-full text-[10px] font-bold uppercase tracking-widest">Disetujui</span>
                            @elseif($transfer->status === 'in_transit')
                                <span class="px-3 py-1 bg-indigo-50 text-indigo-600 border border-indigo-100 rounded-full text-[10px] font-bold uppercase tracking-widest flex items-center gap-1 w-max mx-auto"><i data-lucide="truck" class="w-3 h-3"></i> Perjalanan</span>
                            @elseif($transfer->status === 'received')
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-600 border border-emerald-100 rounded-full text-[10px] font-bold uppercase tracking-widest">Diterima</span>
                            @else
                                <span class="px-3 py-1 bg-slate-100 text-slate-600 border border-slate-200 rounded-full text-[10px] font-bold uppercase tracking-widest">{{ $transfer->status }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="/admin/transfer-barang/{{ $transfer->id }}" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-50 text-slate-600 rounded-lg hover:bg-slate-100 transition-colors text-sm font-bold">
                                <i data-lucide="eye" class="w-4 h-4"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-400">Belum ada riwayat transfer barang.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-6">
            {{ $transfers->links() }}
        </div>
    </div>
</div>
@endsection
