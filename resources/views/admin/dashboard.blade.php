@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="space-y-12">
    <!-- Dynamic Header -->
    <div class="relative overflow-hidden bg-slate-900 rounded-[3rem] p-10 lg:p-16 text-white group">
        <div class="relative z-10 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-8">
            <div class="space-y-6 max-w-2xl">
                <div class="inline-flex items-center gap-3 px-4 py-2 bg-blue-600/20 border border-blue-500/30 rounded-full">
                    <i id="greet-icon" data-lucide="sun" class="w-4 h-4 text-blue-400 animate-pulse"></i>
                    <span id="greet-text" class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-400">Loading...</span>
                </div>
                <h2 class="text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight">Control Center <span class="text-blue-500">Paramitra.</span></h2>
                <p class="text-slate-400 text-lg font-medium leading-relaxed">Sistem memantau seluruh aktivitas distribusi bahan kimia secara real-time. Data diperbarui secara otomatis.</p>
            </div>
            
            <div class="flex items-center gap-4 bg-white/5 backdrop-blur-xl p-6 rounded-[2.5rem] border border-white/10 animate-float">
                <div class="w-12 h-12 bg-emerald-500/20 rounded-2xl flex items-center justify-center text-emerald-400">
                    <i data-lucide="activity" class="w-6 h-6 animate-pulse-soft"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">System Status</p>
                    <h3 class="text-lg font-black text-emerald-400">OPERATIONAL</h3>
                </div>
            </div>
        </div>
        
        <!-- Decoration -->
        <div class="absolute -right-20 -top-20 w-96 h-96 bg-blue-600/10 rounded-full blur-[120px] group-hover:bg-blue-600/20 transition-all duration-1000"></div>
    </div>

    <!-- Animated Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        @php
            $stats = [
                ['label' => 'Total Produk', 'value' => \App\Models\Produk::count(), 'icon' => 'box', 'color' => 'blue'],
                ['label' => 'Pesanan Baru', 'value' => \App\Models\Pesanan::where('status', 'pending')->count(), 'icon' => 'shopping-bag', 'color' => 'amber'],
                ['label' => 'Dalam Kiriman', 'value' => \App\Models\Pesanan::where('status', 'kirim')->count(), 'icon' => 'truck', 'color' => 'indigo'],
                ['label' => 'Mitra Aktif', 'value' => \App\Models\User::where('role', 'pelanggan')->count(), 'icon' => 'users', 'color' => 'emerald'],
            ];
        @endphp

        @foreach($stats as $stat)
        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-50 shadow-xl shadow-slate-200/20 tilt-card group overflow-hidden relative">
            <div class="relative z-10 flex flex-col gap-6">
                <div class="w-14 h-14 bg-{{ $stat['color'] }}-50 rounded-2xl flex items-center justify-center text-{{ $stat['color'] }}-600 group-hover:bg-{{ $stat['color'] }}-600 group-hover:text-white transition-all duration-500">
                    <i data-lucide="{{ $stat['icon'] }}" class="w-6 h-6"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">{{ $stat['label'] }}</p>
                    <h3 class="text-4xl font-black text-slate-800 counter-value" data-target="{{ $stat['value'] }}">0</h3>
                </div>
            </div>
            <div class="absolute -right-4 -bottom-4 text-{{ $stat['color'] }}-50 group-hover:text-{{ $stat['color'] }}-100 transition-colors duration-500">
                <i data-lucide="{{ $stat['icon'] }}" class="w-24 h-24 rotate-12"></i>
            </div>
        </div>
        @endforeach
    </div>

    <!-- ERP Features Section -->
    <div class="mt-12 space-y-6">
        <div class="flex items-center justify-between px-4">
            <h3 class="text-2xl font-black text-slate-800">🚀 Fitur ERP Baru</h3>
            <p class="text-xs text-slate-400">6 Menu tambahan untuk sistem keuangan & supply chain</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Payment Methods Card -->
            <div class="bg-gradient-to-br from-blue-50 to-white p-6 rounded-[2rem] border border-blue-200 shadow-lg hover:shadow-xl transition-all group">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i data-lucide="credit-card" class="w-6 h-6 text-blue-600"></i>
                    </div>
                    <span class="px-3 py-1 bg-blue-100 text-blue-700 text-[10px] font-bold rounded-full">Keuangan</span>
                </div>
                <h4 class="font-bold text-slate-800 mb-2">Metode Pembayaran</h4>
                <p class="text-sm text-slate-600 mb-4">Kelola metode pembayaran: Tunai, Transfer, Giro, E-Wallet</p>
                <a href="{{ route('payment-methods.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-blue-600 hover:text-blue-700">
                    Buka <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

            <!-- Invoice Card -->
            <div class="bg-gradient-to-br from-amber-50 to-white p-6 rounded-[2rem] border border-amber-200 shadow-lg hover:shadow-xl transition-all group">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i data-lucide="file-text" class="w-6 h-6 text-amber-600"></i>
                    </div>
                    <span class="px-3 py-1 bg-amber-100 text-amber-700 text-[10px] font-bold rounded-full">Dokumen</span>
                </div>
                <h4 class="font-bold text-slate-800 mb-2">Invoice & Pembayaran</h4>
                <p class="text-sm text-slate-600 mb-4">Generate invoice otomatis, tracking pembayaran, export PDF</p>
                <a href="{{ route('invoices.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-amber-600 hover:text-amber-700">
                    Buka <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

            <!-- Surat Jalan Card -->
            <div class="bg-gradient-to-br from-purple-50 to-white p-6 rounded-[2rem] border border-purple-200 shadow-lg hover:shadow-xl transition-all group">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i data-lucide="clipboard-list" class="w-6 h-6 text-purple-600"></i>
                    </div>
                    <span class="px-3 py-1 bg-purple-100 text-purple-700 text-[10px] font-bold rounded-full">Pengiriman</span>
                </div>
                <h4 class="font-bold text-slate-800 mb-2">Surat Jalan</h4>
                <p class="text-sm text-slate-600 mb-4">Dokumen pengiriman dengan signature tracking penerima</p>
                <a href="{{ route('surat-jalan.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-purple-600 hover:text-purple-700">
                    Buka <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

            <!-- TT Barang Card -->
            <div class="bg-gradient-to-br from-emerald-50 to-white p-6 rounded-[2rem] border border-emerald-200 shadow-lg hover:shadow-xl transition-all group">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i data-lucide="package" class="w-6 h-6 text-emerald-600"></i>
                    </div>
                    <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-bold rounded-full">Gudang</span>
                </div>
                <h4 class="font-bold text-slate-800 mb-2">TT Barang / Transfer</h4>
                <p class="text-sm text-slate-600 mb-4">Transfer stock antar 3 gudang (Pusat, Regional, Distribusi)</p>
                <a href="{{ route('transfer-barang.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-emerald-600 hover:text-emerald-700">
                    Buka <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

            <!-- Supplier Card -->
            <div class="bg-gradient-to-br from-rose-50 to-white p-6 rounded-[2rem] border border-rose-200 shadow-lg hover:shadow-xl transition-all group">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-12 h-12 bg-rose-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i data-lucide="building" class="w-6 h-6 text-rose-600"></i>
                    </div>
                    <span class="px-3 py-1 bg-rose-100 text-rose-700 text-[10px] font-bold rounded-full">Supply Chain</span>
                </div>
                <h4 class="font-bold text-slate-800 mb-2">Manajemen Supplier</h4>
                <p class="text-sm text-slate-600 mb-4">Kelola supplier, harga, kontak (Sudarshan sudah terdaftar)</p>
                <a href="{{ route('suppliers.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-rose-600 hover:text-rose-700">
                    Buka <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

            <!-- Purchase Order Card -->
            <div class="bg-gradient-to-br from-indigo-50 to-white p-6 rounded-[2rem] border border-indigo-200 shadow-lg hover:shadow-xl transition-all group">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i data-lucide="inbox" class="w-6 h-6 text-indigo-600"></i>
                    </div>
                    <span class="px-3 py-1 bg-indigo-100 text-indigo-700 text-[10px] font-bold rounded-full">Pembelian</span>
                </div>
                <h4 class="font-bold text-slate-800 mb-2">Purchase Order (PO)</h4>
                <p class="text-sm text-slate-600 mb-4">Pesan barang dari supplier, tracking penerimaan barang</p>
                <a href="{{ route('purchase-orders.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-indigo-600 hover:text-indigo-700">
                    Buka <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Workflow Guide -->
    <div class="mt-12 bg-slate-50 p-8 rounded-[2.5rem] border border-slate-200">
        <h3 class="text-2xl font-black text-slate-800 mb-8">📋 Alur Proses ERP</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Flow 1 -->
            <div class="relative">
                <div class="bg-white p-6 rounded-xl border-2 border-blue-500">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold text-sm">1</div>
                        <p class="font-bold text-slate-800">Beli dari Supplier</p>
                    </div>
                    <p class="text-sm text-slate-600">Buat PO → Terima barang → Update stok gudang</p>
                </div>
                <div class="hidden lg:block absolute -right-2 top-1/2 transform translate-x-1/2 -translate-y-1/2">
                    <i data-lucide="arrow-right" class="w-6 h-6 text-slate-300"></i>
                </div>
            </div>

            <!-- Flow 2 -->
            <div class="relative">
                <div class="bg-white p-6 rounded-xl border-2 border-amber-500">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 bg-amber-500 text-white rounded-full flex items-center justify-center font-bold text-sm">2</div>
                        <p class="font-bold text-slate-800">Kelola Stok</p>
                    </div>
                    <p class="text-sm text-slate-600">Pantau stok per gudang → Transfer antar gudang</p>
                </div>
                <div class="hidden lg:block absolute -right-2 top-1/2 transform translate-x-1/2 -translate-y-1/2">
                    <i data-lucide="arrow-right" class="w-6 h-6 text-slate-300"></i>
                </div>
            </div>

            <!-- Flow 3 -->
            <div class="relative">
                <div class="bg-white p-6 rounded-xl border-2 border-emerald-500">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 bg-emerald-500 text-white rounded-full flex items-center justify-center font-bold text-sm">3</div>
                        <p class="font-bold text-slate-800">Proses Order</p>
                    </div>
                    <p class="text-sm text-slate-600">Order masuk → Buat Invoice → Pilih metode bayar</p>
                </div>
                <div class="hidden lg:block absolute -right-2 top-1/2 transform translate-x-1/2 -translate-y-1/2">
                    <i data-lucide="arrow-right" class="w-6 h-6 text-slate-300"></i>
                </div>
            </div>

            <!-- Flow 4 -->
            <div class="relative">
                <div class="bg-white p-6 rounded-xl border-2 border-purple-500">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 bg-purple-500 text-white rounded-full flex items-center justify-center font-bold text-sm">4</div>
                        <p class="font-bold text-slate-800">Pengiriman</p>
                    </div>
                    <p class="text-sm text-slate-600">Buat Surat Jalan → Tracking → Signature penerima</p>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-6">
            <div class="flex items-center justify-between px-4">
                <h3 class="text-2xl font-black text-slate-800">Distribusi Terkini</h3>
                <a href="{{ route('logistics.index') }}" class="text-xs font-bold text-blue-600 hover:underline">Lihat Semua</a>
            </div>
            
            <div class="bg-white rounded-[2.5rem] border border-slate-50 shadow-xl shadow-slate-200/10 overflow-hidden">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Pelanggan</th>
                            <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                            <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach(\App\Models\Pesanan::with('user')->latest()->take(5)->get() as $order)
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-8 py-6">
                                <p class="font-bold text-slate-800">{{ $order->user->name }}</p>
                                <p class="text-[10px] text-slate-400">#ORD-{{ $order->id }}</p>
                            </td>
                            <td class="px-8 py-6">
                                <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest bg-blue-50 text-blue-600 border border-blue-100">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-sm font-medium text-slate-400">
                                {{ $order->created_at->diffForHumans() }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="space-y-6">
            <h3 class="text-2xl font-black text-slate-800 px-4">Info Produk</h3>
            <div class="bg-slate-900 rounded-[2.5rem] p-8 text-white relative overflow-hidden group">
                <div class="relative z-10 space-y-8">
                    <div class="w-16 h-16 bg-blue-600 rounded-[1.5rem] flex items-center justify-center animate-float">
                        <i data-lucide="trending-up" class="w-8 h-8"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold mb-2">Stok Menipis?</h4>
                        <p class="text-slate-400 text-sm leading-relaxed mb-6">Sistem mendeteksi 3 produk di bawah ambang batas stok minimum.</p>
                        <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-blue-400 hover:text-blue-300">
                            Cek Inventori <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
                <div class="absolute -right-10 -bottom-10 opacity-20 rotate-12 group-hover:scale-110 transition-transform duration-700">
                    <i data-lucide="package" class="w-48 h-48"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Set Greeting
        const greet = getGreeting();
        document.getElementById('greet-text').innerText = greet.text;
        document.getElementById('greet-icon').setAttribute('data-lucide', greet.icon);
        lucide.createIcons();

        // Animate Counters
        const counters = document.querySelectorAll('.counter-value');
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            animateValue(counter, 0, target, 2000);
        });
    });
</script>
@endsection
