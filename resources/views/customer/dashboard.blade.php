@extends('layouts.app')

@section('title', 'My Dashboard')

@section('content')
<div class="space-y-12">
    <!-- Dynamic Header -->
    <div class="relative overflow-hidden bg-slate-900 rounded-[3rem] p-10 lg:p-16 text-white group">
        <div class="relative z-10 space-y-6 max-w-2xl">
            <div class="inline-flex items-center gap-3 px-4 py-2 bg-blue-600/20 border border-blue-500/30 rounded-full">
                <i id="greet-icon" data-lucide="sun" class="w-4 h-4 text-blue-400"></i>
                <span id="greet-text" class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-400">Loading...</span>
            </div>
            <h2 class="text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight">Halo, {{ Auth::user()->name }}! <span class="text-blue-500 underline decoration-blue-500/30">Senang melihat Anda kembali.</span></h2>
            <p class="text-slate-400 text-lg font-medium leading-relaxed">Pantau distribusi bahan kimia dan kelola pesanan pigmen Anda dengan mudah dalam satu tempat.</p>
            
            <div class="flex flex-wrap gap-4 pt-4">
                <a href="{{ route('customer.products') }}" class="px-8 py-4 bg-white text-slate-900 rounded-2xl font-bold hover:bg-blue-600 hover:text-white transition-all shadow-xl shadow-blue-500/10 flex items-center gap-2 group/btn">
                    <i data-lucide="plus-circle" class="w-5 h-5 group-hover/btn:rotate-90 transition-transform"></i>
                    Pesan Bahan Kimia
                </a>
            </div>
        </div>
        
        <!-- Decoration -->
        <div class="absolute -right-20 -bottom-20 w-96 h-96 bg-blue-600/10 rounded-full blur-[120px] group-hover:bg-blue-600/20 transition-all duration-1000"></div>
        <div class="absolute right-20 top-20 opacity-5 animate-float">
            <i data-lucide="layers" class="w-64 h-64"></i>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-50 shadow-xl shadow-slate-200/20 flex items-center gap-6 group hover:border-blue-100 transition-all tilt-card">
            <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all duration-500">
                <i data-lucide="shopping-cart" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Pesanan</p>
                <h3 class="text-3xl font-black text-slate-800 counter-value" data-target="{{ $orders->count() }}">0</h3>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-50 shadow-xl shadow-slate-200/20 flex items-center gap-6 group hover:border-amber-100 transition-all tilt-card">
            <div class="w-16 h-16 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition-all duration-500">
                <i data-lucide="file-text" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Invoice</p>
                <h3 class="text-3xl font-black text-slate-800 counter-value" data-target="{{ $invoicesCount }}">0</h3>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-50 shadow-xl shadow-slate-200/20 flex items-center gap-6 group hover:border-red-100 transition-all tilt-card">
            <div class="w-16 h-16 bg-red-50 rounded-2xl flex items-center justify-center text-red-600 group-hover:bg-red-600 group-hover:text-white transition-all duration-500">
                <i data-lucide="circle-dollar-sign" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pembayaran Tertunda</p>
                <h3 class="text-3xl font-black text-slate-800 counter-value" data-target="{{ $pendingPaymentsCount }}">0</h3>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-50 shadow-xl shadow-slate-200/20 flex items-center gap-6 group hover:border-emerald-100 transition-all tilt-card">
            <div class="w-16 h-16 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-500">
                <i data-lucide="truck" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Pengiriman</p>
                <h3 class="text-3xl font-black text-slate-800 counter-value" data-target="{{ $shipmentsCount }}">0</h3>
            </div>
        </div>
    </div>

    <!-- ERP Supply Chain Visualization -->
    <div class="bg-white rounded-[3rem] p-10 border border-slate-100 shadow-xl shadow-slate-200/10 mb-12">
        <h3 class="text-2xl font-black text-slate-800 mb-2">Arsitektur Aliran Distribusi</h3>
        <p class="text-slate-500 text-sm mb-8">Pemantauan rantai pasok pigmen secara transparan dari prinsipal hingga ke fasilitas produksi Anda.</p>
        
        <div class="flex flex-col lg:flex-row items-center justify-between gap-4 relative">
            <!-- Connector Line -->
            <div class="hidden lg:block absolute left-0 right-0 top-1/2 h-1 bg-slate-100 -z-10 rounded-full transform -translate-y-1/2"></div>

            <!-- Node 1 -->
            <div class="flex flex-col items-center bg-white p-4 z-10 w-48">
                <div class="w-16 h-16 bg-rose-50 border-4 border-white shadow-lg rounded-2xl flex items-center justify-center text-rose-600 mb-3 hover:scale-110 transition-transform">
                    <i data-lucide="factory" class="w-8 h-8"></i>
                </div>
                <h4 class="text-xs font-black text-slate-800 text-center uppercase tracking-widest">Sudarshan (India)</h4>
                <p class="text-[10px] text-slate-400 text-center mt-1">Pabrik Utama Pigmen</p>
                <span class="mt-2 px-3 py-1 bg-rose-100 text-rose-700 text-[9px] font-bold rounded-full">Data Stok Bahan</span>
            </div>

            <!-- Arrow -->
            <i data-lucide="arrow-right" class="w-6 h-6 text-slate-300 hidden lg:block bg-white z-10"></i>

            <!-- Node 2 -->
            <div class="flex flex-col items-center bg-white p-4 z-10 w-48">
                <div class="w-16 h-16 bg-blue-50 border-4 border-white shadow-lg rounded-2xl flex items-center justify-center text-blue-600 mb-3 relative hover:scale-110 transition-transform">
                    <i data-lucide="building" class="w-8 h-8"></i>
                    <span class="absolute -top-2 -right-2 w-4 h-4 bg-blue-500 rounded-full animate-ping opacity-75"></span>
                    <span class="absolute -top-2 -right-2 w-4 h-4 bg-blue-500 rounded-full"></span>
                </div>
                <h4 class="text-xs font-black text-slate-800 text-center uppercase tracking-widest">PT Paramitra</h4>
                <p class="text-[10px] text-slate-400 text-center mt-1">Distributor Resmi</p>
                <span class="mt-2 px-3 py-1 bg-blue-100 text-blue-700 text-[9px] font-bold rounded-full">QC & Pengiriman</span>
            </div>

            <!-- Arrow -->
            <i data-lucide="arrow-right" class="w-6 h-6 text-slate-300 hidden lg:block bg-white z-10"></i>

            <!-- Node 3 -->
            <div class="flex flex-col items-center bg-white p-4 z-10 w-48">
                <div class="w-16 h-16 bg-emerald-50 border-4 border-white shadow-lg rounded-2xl flex items-center justify-center text-emerald-600 mb-3 hover:scale-110 transition-transform">
                    <i data-lucide="warehouse" class="w-8 h-8"></i>
                </div>
                <h4 class="text-xs font-black text-slate-800 text-center uppercase tracking-widest">{{ Auth::user()->name }}</h4>
                <p class="text-[10px] text-slate-400 text-center mt-1">Industri / Distributor</p>
                <span class="mt-2 px-3 py-1 bg-emerald-100 text-emerald-700 text-[9px] font-bold rounded-full">Penerima Pesanan</span>
            </div>

            <!-- Arrow -->
            <i data-lucide="arrow-right" class="w-6 h-6 text-slate-300 hidden lg:block bg-white z-10"></i>

            <!-- Node 4 -->
            <div class="flex flex-col items-center bg-white p-4 z-10 w-48">
                <div class="w-16 h-16 bg-amber-50 border-4 border-white shadow-lg rounded-2xl flex items-center justify-center text-amber-600 mb-3 hover:scale-110 transition-transform">
                    <i data-lucide="users" class="w-8 h-8"></i>
                </div>
                <h4 class="text-xs font-black text-slate-800 text-center uppercase tracking-widest">Konsumen Akhir</h4>
                <p class="text-[10px] text-slate-400 text-center mt-1">Pasar Ritel</p>
                <span class="mt-2 px-3 py-1 bg-amber-100 text-amber-700 text-[9px] font-bold rounded-full">Data Penjualan</span>
            </div>
        </div>
    </div>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <h3 class="text-2xl font-black text-slate-800 tracking-tight">Riwayat Pesanan</h3>
            <span class="px-4 py-2 bg-slate-100 text-slate-500 text-[10px] font-black uppercase tracking-widest rounded-full">Newest First</span>
        </div>

        <div class="grid grid-cols-1 gap-6">
            @forelse($orders as $order)
            <div class="bg-white rounded-[2.5rem] border border-slate-100 p-8 hover:border-blue-100 transition-all duration-500 group relative overflow-hidden shadow-xl shadow-slate-200/10">
                <div class="flex flex-col lg:flex-row justify-between gap-8 relative z-10">
                    <div class="flex gap-6">
                        <div class="w-20 h-20 bg-slate-50 rounded-[1.5rem] flex items-center justify-center text-slate-300 group-hover:text-blue-200 transition-colors duration-500">
                            <i data-lucide="box" class="w-8 h-8"></i>
                        </div>
                        <div class="space-y-1">
                            <div class="flex items-center gap-3">
                                <span class="font-mono text-[10px] font-bold bg-blue-50 text-blue-600 px-3 py-1 rounded-full border border-blue-100">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ \Carbon\Carbon::parse($order->tanggal_pesanan)->format('d M Y') }}</span>
                            </div>
                            <h4 class="text-xl font-black text-slate-800">
                                @foreach($order->detailPesanan as $detail)
                                    {{ $detail->produk->nama_produk }} @if(!$loop->last), @endif
                                @endforeach
                            </h4>
                            <p class="text-sm font-medium text-slate-400">Total Pembayaran: <span class="text-slate-900 font-black">Rp{{ number_format($order->total_harga, 0, ',', '.') }}</span></p>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row items-center gap-4 lg:self-center">
                        @php
                            $statusMap = [
                                'pending' => ['bg' => 'bg-amber-50', 'text' => 'text-amber-600', 'border' => 'border-amber-100', 'icon' => 'clock'],
                                'proses' => ['bg' => 'bg-blue-50', 'text' => 'text-blue-600', 'border' => 'border-blue-100', 'icon' => 'loader'],
                                'kirim' => ['bg' => 'bg-indigo-50', 'text' => 'text-indigo-600', 'border' => 'border-indigo-100', 'icon' => 'truck'],
                                'selesai' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600', 'border' => 'border-emerald-100', 'icon' => 'check-circle-2'],
                            ];
                            $st = $statusMap[$order->status];
                        @endphp
                        
                        <div class="px-6 py-3 {{ $st['bg'] }} {{ $st['text'] }} {{ $st['border'] }} border rounded-2xl flex items-center gap-3 font-bold text-xs uppercase tracking-widest">
                            <i data-lucide="{{ $st['icon'] }}" class="w-4 h-4 {{ $order->status === 'proses' ? 'animate-spin' : '' }}"></i>
                            {{ $order->status }}
                        </div>

                        <div class="flex items-center gap-2">
                            @if($order->invoice)
                            <a href="{{ route('customer.invoices.show', $order->invoice->id) }}" class="px-4 py-2 bg-slate-100 text-slate-500 rounded-lg hover:bg-blue-600 hover:text-white transition-all text-sm font-medium" title="View Invoice">
                                <i data-lucide="file-text" class="w-4 h-4"></i>
                            </a>
                            @endif
                            <a href="{{ route('customer.payments.index', ['order_id' => $order->id]) }}" class="px-4 py-2 bg-slate-100 text-slate-500 rounded-lg hover:bg-emerald-600 hover:text-white transition-all text-sm font-medium" title="View Payments">
                                <i data-lucide="circle-dollar-sign" class="w-4 h-4"></i>
                            </a>
                            @if($order->pengiriman)
                            <a href="{{ route('customer.shipments.show', $order->pengiriman->id) }}" class="px-4 py-2 bg-slate-100 text-slate-500 rounded-lg hover:bg-indigo-600 hover:text-white transition-all text-sm font-medium" title="View Shipment">
                                <i data-lucide="truck" class="w-4 h-4"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Progress Line for active orders -->
                @if($order->status !== 'selesai' && $order->status !== 'pending')
                <div class="mt-8 h-1 w-full bg-slate-100 rounded-full overflow-hidden">
                    <div class="h-full bg-blue-600 rounded-full animate-pulse-soft" style="width: {{ $order->status === 'proses' ? '50%' : '80%' }}"></div>
                </div>
                @endif
            </div>
            @empty
            <div class="bg-white rounded-[3rem] p-20 text-center border border-slate-100 border-dashed">
                <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-8 animate-float">
                    <i data-lucide="shopping-cart" class="w-10 h-10 text-slate-200"></i>
                </div>
                <h3 class="text-xl font-black text-slate-800 mb-2">Belum ada pesanan</h3>
                <p class="text-slate-500 mb-8">Mulai proyek Anda sekarang dengan memesan bahan kimia terbaik.</p>
                <a href="{{ route('customer.products') }}" class="inline-flex items-center gap-3 px-10 py-4 bg-blue-600 text-white rounded-2xl font-bold hover:bg-blue-700 transition-all shadow-xl shadow-blue-200">
                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                    Belanja Sekarang
                </a>
            </div>
            @endforelse
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const greet = getGreeting();
        document.getElementById('greet-text').innerText = greet.text;
        document.getElementById('greet-icon').setAttribute('data-lucide', greet.icon);
        lucide.createIcons();

        const counters = document.querySelectorAll('.counter-value');
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            animateValue(counter, 0, target, 1500);
        });
    });
</script>
@endsection
