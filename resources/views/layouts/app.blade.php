<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PT Paramitra') - Operational Portal</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap');
        
        :root {
            --primary: 221.2 83.2% 53.3%;
            --bg-main: 222 47% 11%;
            --card-bg: 0 0% 100%;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f1f5f9;
            color: #1e293b;
        }

        /* Skeleton Animation */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: skeleton-loading 1.5s infinite linear;
        }

        @keyframes skeleton-loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        .sidebar-item-active {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.1) 0%, rgba(37, 99, 235, 0.02) 100%);
            color: #2563eb;
            border-right: 4px solid #2563eb;
        }

        /* Advanced Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(2deg); }
        }
        
        .animate-float { animation: float 6s ease-in-out infinite; }

        @keyframes pulse-soft {
            0%, 100% { transform: scale(1); opacity: 0.8; }
            50% { transform: scale(1.05); opacity: 1; }
        }

        .animate-pulse-soft { animation: pulse-soft 3s ease-in-out infinite; }

        .tilt-card { transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1); }
        .tilt-card:hover { transform: translateY(-8px) scale(1.01); }

        .glass-premium {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(15px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        /* Number Counter Animation Helper */
        @property --num {
            syntax: "<integer>";
            initial-value: 0;
            inherits: false;
        }
    </style>
    <script>
        // Number Counter Logic
        function animateValue(obj, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                obj.innerHTML = Math.floor(progress * (end - start) + start).toLocaleString('id-ID');
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        }

        // Dynamic Greeting
        function getGreeting() {
            const hour = new Date().getHours();
            if (hour < 11) return { text: "Selamat Pagi", icon: "sun" };
            if (hour < 15) return { text: "Selamat Siang", icon: "cloud-sun" };
            if (hour < 19) return { text: "Selamat Sore", icon: "sunset" };
            return { text: "Selamat Malam", icon: "moon" };
        }
    </script>
</head>
<body class="antialiased">
    <!-- Initial Loader -->
    <div id="page-loader" class="fixed inset-0 z-[100] bg-white flex items-center justify-center transition-opacity duration-500">
        <div class="relative">
            <div class="w-16 h-16 border-4 border-blue-100 border-t-blue-600 rounded-full animate-spin"></div>
            <div class="mt-4 text-slate-400 font-medium text-sm animate-pulse">Loading Paramitra...</div>
        </div>
    </div>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed left-0 top-0 h-screen w-72 bg-white z-50 transition-all duration-300 -translate-x-full lg:translate-x-0 border-r border-slate-100">
        <div class="h-full flex flex-col p-8">
            <div class="flex items-center gap-4 mb-12 group">
                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-xl shadow-blue-500/10 group-hover:scale-110 transition-transform duration-500 overflow-hidden border border-slate-100">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10 h-10 object-contain">
                </div>
                <div>
                    <h1 class="text-sm font-black text-slate-800 tracking-tight leading-tight uppercase">PT Paramitra</h1>
                    <p class="text-[9px] font-bold text-blue-600 tracking-[0.2em] uppercase">Praya Prawatya</p>
                </div>
            </div>

            <nav class="flex-grow space-y-2 overflow-y-auto min-h-0 pr-4 pb-4 -mr-4">
                @php $role = Auth::user()->role; @endphp

                @if($role === 'admin')
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4 px-4">Menu Utama</p>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('admin.dashboard') ? 'sidebar-item-active' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                        <i data-lucide="grid" class="w-5 h-5"></i>
                        <span class="font-semibold">Overview</span>
                    </a>

                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4 px-4 mt-6">Operasional</p>
                    <a href="{{ route('products.index') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('products.*') ? 'sidebar-item-active' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                        <i data-lucide="box" class="w-5 h-5"></i>
                        <span class="font-semibold">Inventori</span>
                    </a>
                    <a href="{{ route('customers.index') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('customers.*') ? 'sidebar-item-active' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                        <i data-lucide="users" class="w-5 h-5"></i>
                        <span class="font-semibold">Pelanggan</span>
                    </a>
                    <a href="{{ route('orders.index') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('orders.*') ? 'sidebar-item-active' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                        <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                        <span class="font-semibold">Transaksi</span>
                    </a>
                    <a href="{{ route('logistics.index') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('logistics.*') ? 'sidebar-item-active' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                        <i data-lucide="truck" class="w-5 h-5"></i>
                        <span class="font-semibold">Pengiriman</span>
                    </a>

                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4 px-4 mt-6">Keuangan & Dokumen</p>
                    <a href="{{ route('payment-methods.index') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('payment-methods.*') ? 'sidebar-item-active' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                        <i data-lucide="credit-card" class="w-5 h-5"></i>
                        <span class="font-semibold">Metode Bayar</span>
                    </a>
                    <a href="{{ route('invoices.index') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('invoices.*') ? 'sidebar-item-active' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                        <i data-lucide="file-text" class="w-5 h-5"></i>
                        <span class="font-semibold">Invoice</span>
                    </a>
                    <a href="{{ route('surat-jalan.index') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('surat-jalan.*') ? 'sidebar-item-active' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                        <i data-lucide="clipboard-list" class="w-5 h-5"></i>
                        <span class="font-semibold">Surat Jalan</span>
                    </a>

                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4 px-4 mt-6">Gudang & Supplier</p>
                    <a href="{{ route('transfer-barang.index') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('transfer-barang.*') ? 'sidebar-item-active' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                        <i data-lucide="package" class="w-5 h-5"></i>
                        <span class="font-semibold">TT Barang</span>
                    </a>
                    <a href="{{ route('suppliers.index') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('suppliers.*') ? 'sidebar-item-active' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                        <i data-lucide="building" class="w-5 h-5"></i>
                        <span class="font-semibold">Supplier</span>
                    </a>
                    <a href="{{ route('purchase-orders.index') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('purchase-orders.*') ? 'sidebar-item-active' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                        <i data-lucide="inbox" class="w-5 h-5"></i>
                        <span class="font-semibold">PO Supplier</span>
                    </a>

                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4 px-4 mt-6">Laporan & Histori</p>
                    <a href="{{ route('arsip.index') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('arsip.*') ? 'sidebar-item-active' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                        <i data-lucide="archive" class="w-5 h-5"></i>
                        <span class="font-semibold">Arsip Pesanan</span>
                    </a>
                @elseif($role === 'manajemen')
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4 px-4">Dashboard & Laporan</p>
                    <a href="{{ route('manajemen.dashboard') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('manajemen.dashboard') ? 'sidebar-item-active' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                        <i data-lucide="bar-chart-3" class="w-5 h-5"></i>
                        <span class="font-semibold">Analitik</span>
                    </a>
                    <a href="{{ route('manajemen.report') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('manajemen.report') ? 'sidebar-item-active' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                        <i data-lucide="file-text" class="w-5 h-5"></i>
                        <span class="font-semibold">Laporan</span>
                    </a>
                    
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4 px-4 mt-6">Pengawasan View-Only</p>
                    <a href="{{ route('products.index') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('products.*') ? 'sidebar-item-active' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                        <i data-lucide="box" class="w-5 h-5"></i>
                        <span class="font-semibold">Inventori</span>
                    </a>
                    <a href="{{ route('customers.index') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('customers.*') ? 'sidebar-item-active' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                        <i data-lucide="users" class="w-5 h-5"></i>
                        <span class="font-semibold">Pelanggan</span>
                    </a>
                    <a href="{{ route('suppliers.index') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('suppliers.*') ? 'sidebar-item-active' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                        <i data-lucide="building" class="w-5 h-5"></i>
                        <span class="font-semibold">Supplier</span>
                    </a>
                    <a href="{{ route('purchase-orders.index') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('purchase-orders.*') ? 'sidebar-item-active' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                        <i data-lucide="inbox" class="w-5 h-5"></i>
                        <span class="font-semibold">PO Supplier</span>
                    </a>
                    <a href="{{ route('invoices.index') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('invoices.*') ? 'sidebar-item-active' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                        <i data-lucide="file-text" class="w-5 h-5"></i>
                        <span class="font-semibold">Invoice Keuangan</span>
                    </a>

                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4 px-4 mt-6">Histori</p>
                    <a href="{{ route('manajemen.arsip') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('manajemen.arsip') ? 'sidebar-item-active' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                        <i data-lucide="archive" class="w-5 h-5"></i>
                        <span class="font-semibold">Arsip Pesanan</span>
                    </a>
                @else
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4 px-4">Menu Utama</p>
                    <a href="{{ route('customer.dashboard') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('customer.dashboard') ? 'sidebar-item-active' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                        <i data-lucide="layout" class="w-5 h-5"></i>
                        <span class="font-semibold">Dashboard</span>
                    </a>
                    <a href="{{ route('customer.products') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('customer.products') ? 'sidebar-item-active' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                        <i data-lucide="shopping-bag" class="w-5 h-5"></i>
                        <span class="font-semibold">Pesan Barang</span>
                    </a>

                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4 px-4 mt-6">Pesanan & Pembayaran</p>
                    <a href="{{ route('customer.invoices.index') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('customer.invoices*') ? 'sidebar-item-active' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                        <i data-lucide="file-text" class="w-5 h-5"></i>
                        <span class="font-semibold">Invoice</span>
                    </a>
                    <a href="{{ route('customer.payments.index') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('customer.payments*') ? 'sidebar-item-active' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                        <i data-lucide="credit-card" class="w-5 h-5"></i>
                        <span class="font-semibold">Pembayaran</span>
                    </a>
                    <a href="{{ route('customer.shipments.index') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('customer.shipments*') ? 'sidebar-item-active' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                        <i data-lucide="truck" class="w-5 h-5"></i>
                        <span class="font-semibold">Pengiriman</span>
                    </a>

                @endif
            </nav>

            <div class="mt-auto">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-4 px-6 py-4 rounded-2xl text-red-500 bg-red-50 hover:bg-red-100 transition-all font-bold">
                        <i data-lucide="power" class="w-5 h-5"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main id="main-content" class="lg:ml-72 min-h-screen transition-all duration-300">
        <!-- Topbar -->
        <header class="sticky top-0 z-40 px-8 py-6 flex items-center justify-between bg-white/70 backdrop-blur-xl border-b border-slate-100">
            <div class="flex items-center gap-6">
                <button id="sidebar-toggle" class="lg:hidden p-3 bg-slate-100 rounded-xl">
                    <i data-lucide="menu" class="w-5 h-5"></i>
                </button>
                <div class="hidden sm:block">
                    <h2 class="text-xs font-bold text-slate-400 uppercase tracking-[0.3em]">Operational Portal</h2>
                </div>
            </div>

            <div class="flex items-center gap-6">
                @if($role === 'pelanggan')
                <a href="{{ route('customer.cart') }}" class="relative group">
                    <div class="p-3 bg-slate-50 rounded-xl group-hover:bg-blue-50 transition-all">
                        <i data-lucide="shopping-bag" class="w-5 h-5 text-slate-600 group-hover:text-blue-600"></i>
                    </div>
                    <span class="absolute -top-1 -right-1 w-5 h-5 bg-blue-600 text-white text-[10px] font-bold flex items-center justify-center rounded-full border-2 border-white">
                        {{ count(session('cart', [])) }}
                    </span>
                </a>
                @endif

                <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-slate-800 to-slate-900 flex items-center justify-center text-white text-sm font-bold shadow-xl shadow-slate-200">
                    {{ Auth::user()->role === 'pelanggan' ? 'C' : substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </header>

        <div class="p-8">
            <!-- Messages -->
            @if(session('success'))
                <div class="mb-8 p-4 bg-emerald-500 text-white rounded-2xl flex items-center gap-4 shadow-lg shadow-emerald-200 slide-in">
                    <i data-lucide="check-circle" class="w-6 h-6"></i>
                    <span class="font-bold text-sm">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-8 p-4 bg-red-500 text-white rounded-2xl flex items-center gap-4 shadow-lg shadow-red-200 slide-in">
                    <i data-lucide="alert-circle" class="w-6 h-6"></i>
                    <span class="font-bold text-sm">{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="mt-20 px-8 py-16 bg-slate-900 text-slate-400 border-t border-slate-800">
            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-16">
                <div class="max-w-sm space-y-8">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/10 overflow-hidden">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-8 h-8 object-contain">
                        </div>
                        <span class="font-bold text-white text-lg tracking-tight uppercase">PT PARAMITRA</span>
                    </div>
                    <p class="text-sm leading-relaxed">Penyedia terpercaya pigmen warna dan bahan kimia industri berkualitas tinggi. Melayani kebutuhan manufaktur cat, plastik, tinta, dan industri lainnya.</p>
                </div>

                <div class="space-y-8">
                    <h4 class="text-[10px] font-black text-white uppercase tracking-[0.3em]">Lokasi Kantor</h4>
                    <div class="flex gap-4 group">
                        <div class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center text-blue-500 shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-all duration-500 border border-white/5">
                            <i data-lucide="map-pin" class="w-6 h-6"></i>
                        </div>
                        <p class="text-sm leading-relaxed group-hover:text-slate-200 transition-colors">
                            Pergudangan Bizpark I Pulo Gadung Blok A6 No. 2-6, Jl. Raya Bekasi KM. 21, Cakung, Jakarta Timur, 13920
                        </p>
                    </div>
                </div>

                <div class="space-y-8">
                    <h4 class="text-[10px] font-black text-white uppercase tracking-[0.3em]">Kontak Resmi</h4>
                    <div class="space-y-6">
                        <div class="flex gap-4 group">
                            <div class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center text-blue-500 shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-all duration-500 border border-white/5">
                                <i data-lucide="phone" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Telepon</p>
                                <p class="text-sm font-bold text-white tracking-wide">(021) 29368791</p>
                            </div>
                        </div>
                        <div class="flex gap-4 group">
                            <div class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center text-blue-500 shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-all duration-500 border border-white/5">
                                <i data-lucide="mail" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Email</p>
                                <p class="text-sm font-bold text-white tracking-wide">contact@paramitra.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto mt-20 pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-600">&copy; 2026 PT Paramitra Praya Prawatya. All rights reserved.</p>
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-slate-600">System Secure</span>
                </div>
            </div>
        </footer>
    </main>

    <script>
        lucide.createIcons();
        
        // Loader handling
        window.addEventListener('load', () => {
            const loader = document.getElementById('page-loader');
            loader.style.opacity = '0';
            setTimeout(() => loader.remove(), 500);
        });

        // Sidebar Toggle
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebar-toggle');
        sidebarToggle?.addEventListener('click', () => sidebar.classList.toggle('-translate-x-full'));
    </script>
</body>
</html>
