@extends('layouts.app')

@section('title', 'Manajemen Surat Jalan')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Manajemen Surat Jalan</h2>
            <p class="text-slate-500 text-sm">Kelola dan cetak surat jalan / delivery order (DO) untuk kurir.</p>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="px-6 py-4 text-sm font-semibold text-slate-600">No. Surat Jalan</th>
                        <th class="px-6 py-4 text-sm font-semibold text-slate-600">Pelanggan</th>
                        <th class="px-6 py-4 text-sm font-semibold text-slate-600">Penerima</th>
                        <th class="px-6 py-4 text-sm font-semibold text-slate-600">Status</th>
                        <th class="px-6 py-4 text-sm font-semibold text-slate-600 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($suratJalans as $sj)
                    <tr class="hover:bg-slate-50 transition-colors group">
                        <td class="px-6 py-4">
                            <span class="font-mono font-bold text-slate-800">{{ $sj->no_surat_jalan }}</span>
                            <p class="text-[10px] text-slate-400 uppercase tracking-widest mt-1">Resi Kirim: {{ $sj->pengiriman->no_resi }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-bold text-slate-800">{{ $sj->pengiriman->pesanan->user->name }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-bold text-slate-800">{{ $sj->penerima_nama }}</p>
                        </td>
                        <td class="px-6 py-4">
                            @if($sj->status === 'diterima')
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-600 border border-emerald-100 rounded-full text-xs font-bold uppercase tracking-widest">Diterima</span>
                            @else
                                <span class="px-3 py-1 bg-blue-50 text-blue-600 border border-blue-100 rounded-full text-xs font-bold uppercase tracking-widest">{{ $sj->status }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('surat-jalan.show', $sj) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white rounded-xl font-bold text-xs transition-all border border-blue-100">
                                <i data-lucide="printer" class="w-4 h-4"></i>
                                Cetak DO / QR
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-500">Belum ada Surat Jalan yang diterbitkan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($suratJalans->hasPages())
        <div class="p-6 border-t border-slate-100">
            {{ $suratJalans->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
