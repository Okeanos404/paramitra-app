@extends('layouts.app')

@section('title', 'Manajemen Analytics')

@section('content')
<div class="space-y-12">
    <!-- Analytics Header -->
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-8">
        <div class="space-y-2">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-blue-50 text-blue-600 rounded-lg text-[10px] font-black uppercase tracking-widest border border-blue-100">
                <i data-lucide="bar-chart-3" class="w-3 h-3"></i>
                Performance Data
            </div>
            <h2 class="text-4xl font-black text-slate-900 tracking-tight">Executive <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Overview.</span></h2>
            <p class="text-slate-500 font-medium">Analisis performa penjualan dan efisiensi distribusi secara real-time.</p>
        </div>

        <div class="flex gap-4">
            <a href="{{ route('manajemen.report') }}" class="px-8 py-4 bg-white text-slate-800 border border-slate-100 rounded-2xl font-bold hover:bg-slate-50 transition-all shadow-xl shadow-slate-200/20 flex items-center gap-2">
                <i data-lucide="file-text" class="w-5 h-5"></i>
                Download PDF
            </a>
        </div>
    </div>

    <!-- Animated Performance Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white p-8 rounded-[3rem] border border-slate-50 shadow-xl shadow-slate-200/10 tilt-card group relative overflow-hidden">
            <div class="relative z-10 space-y-6">
                <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all">
                    <i data-lucide="dollar-sign" class="w-6 h-6"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Penjualan</p>
                    <div class="flex items-baseline gap-1">
                        <span class="text-lg font-bold text-slate-400">Rp</span>
                        <h3 class="text-3xl font-black text-slate-800 counter-value" data-target="{{ $total_penjualan }}">0</h3>
                    </div>
                </div>
            </div>
            <!-- Mini Sparkline Simulation -->
            <div class="absolute bottom-0 left-0 w-full h-24 bg-gradient-to-t from-blue-50/50 to-transparent">
                <svg class="w-full h-full" viewBox="0 0 100 40" preserveAspectRatio="none">
                    <path d="M0 35 Q 25 10, 50 30 T 100 5" fill="none" stroke="#3b82f6" stroke-width="2" class="animate-pulse-soft"></path>
                </svg>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[3rem] border border-slate-50 shadow-xl shadow-slate-200/10 tilt-card group relative overflow-hidden">
            <div class="relative z-10 space-y-6">
                <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-all">
                    <i data-lucide="package-check" class="w-6 h-6"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Produk Terjual</p>
                    <h3 class="text-4xl font-black text-slate-800 counter-value" data-target="{{ $produk_terjual }}">0</h3>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-24 bg-gradient-to-t from-emerald-50/50 to-transparent">
                <svg class="w-full h-full" viewBox="0 0 100 40" preserveAspectRatio="none">
                    <path d="M0 30 Q 25 35, 50 15 T 100 10" fill="none" stroke="#10b981" stroke-width="2" class="animate-pulse-soft"></path>
                </svg>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[3rem] border border-slate-50 shadow-xl shadow-slate-200/10 tilt-card group relative overflow-hidden">
            <div class="relative z-10 space-y-6">
                <div class="w-14 h-14 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition-all">
                    <i data-lucide="users" class="w-6 h-6"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Mitra</p>
                    <h3 class="text-4xl font-black text-slate-800 counter-value" data-target="{{ $total_pelanggan }}">0</h3>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-24 bg-gradient-to-t from-amber-50/50 to-transparent">
                <svg class="w-full h-full" viewBox="0 0 100 40" preserveAspectRatio="none">
                    <path d="M0 38 Q 25 20, 50 30 T 100 15" fill="none" stroke="#f59e0b" stroke-width="2" class="animate-pulse-soft"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Detailed Analytics Table -->
    <div class="space-y-6">
        <h3 class="text-2xl font-black text-slate-800 px-4">Sales Performance Details</h3>
        <div class="bg-white rounded-[3rem] border border-slate-50 shadow-xl shadow-slate-200/10 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-widest">Pelanggan</th>
                            <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Item</th>
                            <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Total Transaksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($recent_orders as $order)
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-10 py-8">
                                <p class="font-bold text-slate-800 group-hover:text-blue-600 transition-colors">{{ $order->user->name }}</p>
                                <p class="text-[10px] font-bold text-slate-400 mt-1 uppercase tracking-widest">{{ $order->tanggal_pesanan->format('d M Y') }}</p>
                            </td>
                            <td class="px-10 py-8 text-center">
                                <div class="inline-flex items-center justify-center px-4 py-1.5 bg-slate-100 text-slate-600 rounded-full text-[10px] font-black group-hover:bg-blue-600 group-hover:text-white transition-all">
                                    {{ $order->detailPesanan->sum('jumlah') }} UNIT
                                </div>
                            </td>
                            <td class="px-10 py-8 text-right font-black text-slate-800">
                                Rp{{ number_format($order->total_harga, 0, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const counters = document.querySelectorAll('.counter-value');
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            animateValue(counter, 0, target, 2000);
        });
    });
</script>
@endsection
