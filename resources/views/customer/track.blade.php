@extends('layouts.app')

@section('title', 'Lacak Pesanan')

@section('content')
<div class="max-w-2xl mx-auto space-y-8">
    <div class="flex items-center gap-4">
        <a href="{{ route('customer.dashboard') }}" class="p-2 hover:bg-white rounded-full transition-all">
            <i data-lucide="arrow-left" class="w-6 h-6 text-slate-600"></i>
        </a>
        <h2 class="text-2xl font-bold text-slate-800">Detail Pelacakan</h2>
    </div>

    @if($pesanan->pengiriman)
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-8 space-y-8">
        <div class="flex flex-col md:flex-row justify-between gap-6 pb-8 border-b border-slate-50">
            <div>
                <p class="text-xs text-slate-400 uppercase font-bold tracking-wider mb-1">Nomor Resi</p>
                <h3 class="text-xl font-bold text-blue-600">{{ $pesanan->pengiriman->no_resi }}</h3>
            </div>
            <div>
                <p class="text-xs text-slate-400 uppercase font-bold tracking-wider mb-1">Kurir</p>
                <h3 class="text-lg font-bold text-slate-800">{{ $pesanan->pengiriman->kurir }}</h3>
            </div>
            <div>
                <p class="text-xs text-slate-400 uppercase font-bold tracking-wider mb-1">Status</p>
                <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-xs font-bold border border-emerald-100 capitalize">
                    {{ $pesanan->pengiriman->status_kirim }}
                </span>
            </div>
        </div>

        <!-- Vertical Timeline -->
        <div class="relative space-y-8 before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-200 before:to-transparent">
            @foreach($pesanan->pengiriman->distribusi as $log)
            <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active slide-in">
                <!-- Dot -->
                <div class="flex items-center justify-center w-10 h-10 rounded-full border border-white bg-slate-200 group-[.is-active]:bg-blue-600 text-slate-500 group-[.is-active]:text-white shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 transition-colors duration-500">
                    <i data-lucide="check" class="w-5 h-5"></i>
                </div>
                <!-- Content -->
                <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all">
                    <div class="flex items-center justify-between space-x-2 mb-1">
                        <div class="font-bold text-slate-800">{{ $log->lokasi_terkini }}</div>
                        <time class="font-mono text-xs text-blue-600">{{ $log->created_at->format('H:i') }}</time>
                    </div>
                    <div class="text-slate-500 text-sm mb-2">{{ $log->catatan }}</div>
                    <div class="text-xs text-slate-400">{{ $log->created_at->format('d M Y') }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <div class="bg-white rounded-3xl border border-slate-100 p-12 text-center text-slate-500">
        Informasi pengiriman belum tersedia.
    </div>
    @endif
</div>
@endsection
