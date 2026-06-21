@extends('layouts.app')

@section('title', 'Katalog Material')

@section('content')
<div class="space-y-12">
    <!-- Header Section -->
    <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-8">
        <div class="space-y-2">
            <div class="flex items-center gap-2 text-blue-600 font-bold text-xs uppercase tracking-widest">
                <span class="w-8 h-[2px] bg-blue-600"></span>
                Official Distributor
            </div>
            <h2 class="text-4xl font-extrabold text-slate-900 tracking-tight">Katalog <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Bahan Kimia.</span></h2>
            <p class="text-slate-500 font-medium">Bahan baku pigmen premium yang dipasok langsung oleh <span class="font-bold text-slate-800">Sudarshan Chemical Industries Ltd (India)</span>.</p>
        </div>
        
        <form action="{{ route('customer.products') }}" method="GET" class="w-full lg:w-96">
            <div class="flex items-center gap-4 bg-white p-2 rounded-2xl border border-slate-100 shadow-xl shadow-slate-100/50">
                <div class="p-3 bg-slate-50 rounded-xl">
                    <i data-lucide="search" class="w-5 h-5 text-slate-400"></i>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari bahan kimia..." class="bg-transparent border-none outline-none text-sm font-medium text-slate-600 w-full focus:ring-0">
                <button type="submit" class="hidden"></button>
            </div>
        </form>
    </div>

    <!-- Category Tabs -->
    <div class="flex items-center gap-3 overflow-x-auto pb-4 no-scrollbar">
        <a href="{{ route('customer.products', ['search' => request('search')]) }}" 
           class="px-8 py-3 rounded-2xl text-sm font-bold transition-all shrink-0 {{ !request('category') ? 'bg-slate-900 text-white shadow-xl shadow-slate-200' : 'bg-white text-slate-500 border border-slate-100 hover:border-blue-100 hover:text-blue-600 shadow-sm' }}">
           Semua Produk
        </a>
        <a href="{{ route('customer.products', ['category' => 'pigmen', 'search' => request('search')]) }}" 
           class="px-8 py-3 rounded-2xl text-sm font-bold transition-all shrink-0 {{ request('category') === 'pigmen' ? 'bg-slate-900 text-white shadow-xl shadow-slate-200' : 'bg-white text-slate-500 border border-slate-100 hover:border-blue-100 hover:text-blue-600 shadow-sm' }}">
           Pigmen Warna (Sudarshan)
        </a>
        <a href="{{ route('customer.products', ['category' => 'kimia', 'search' => request('search')]) }}" 
           class="px-8 py-3 rounded-2xl text-sm font-bold transition-all shrink-0 {{ request('category') === 'kimia' ? 'bg-slate-900 text-white shadow-xl shadow-slate-200' : 'bg-white text-slate-500 border border-slate-100 hover:border-blue-100 hover:text-blue-600 shadow-sm' }}">
           Bahan Tinta & Plastik
        </a>
    </div>

    <!-- Simulated Skeleton Loader -->
    <div id="skeleton-grid" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8">
        @for($i = 0; $i < 4; $i++)
        <div class="bg-white p-6 rounded-[2.5rem] border border-slate-50 space-y-6">
            <div class="aspect-square skeleton rounded-[2rem]"></div>
            <div class="space-y-3">
                <div class="h-6 skeleton w-3/4 rounded-lg"></div>
                <div class="h-4 skeleton w-1/2 rounded-lg"></div>
            </div>
            <div class="flex justify-between items-center pt-4">
                <div class="h-8 skeleton w-24 rounded-lg"></div>
                <div class="w-12 h-12 skeleton rounded-xl"></div>
            </div>
        </div>
        @endfor
    </div>

    <!-- Actual Content -->
    <div id="actual-content" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8 hidden">
        @forelse($products as $product)
        <div class="group relative bg-white p-6 rounded-[2.5rem] border border-slate-100 hover:border-blue-100 transition-all duration-500 hover:shadow-2xl hover:shadow-blue-500/10 active:scale-[0.98] tilt-card">
            <!-- Product Badge -->
            <div class="absolute top-8 left-8 z-10">
                <div class="px-4 py-1.5 bg-white/90 backdrop-blur-md border border-white text-[10px] font-black text-blue-600 uppercase tracking-widest rounded-full shadow-sm">
                    {{ $product->kategori }}
                </div>
            </div>

            <!-- Image Section -->
            <div class="aspect-square rounded-[2rem] bg-gradient-to-br from-slate-50 to-slate-100 mb-8 flex items-center justify-center relative overflow-hidden group-hover:from-blue-50 group-hover:to-indigo-50 transition-colors duration-500">
                @if($product->image)
                    <img src="{{ asset($product->image) }}" alt="{{ $product->nama_produk }}" class="w-full h-full object-cover group-hover:scale-110 transition-all duration-700">
                @else
                    <i data-lucide="package" class="w-16 h-16 text-slate-200 group-hover:text-blue-200 transition-all duration-700 group-hover:scale-110"></i>
                @endif

                <!-- Official Watermark -->
                <div class="absolute inset-x-0 bottom-0 p-4 bg-gradient-to-t from-slate-900/60 to-transparent flex items-center gap-3">
                    <div class="w-7 h-7 bg-white rounded-lg flex items-center justify-center shadow-lg p-1">
                        <img src="{{ asset('images/logo.png') }}" alt="Watermark" class="w-full h-full object-contain">
                    </div>
                    <span class="text-[8px] font-black text-white uppercase tracking-widest drop-shadow-lg">PT Paramitra Praya Prawatya</span>
                </div>
                
                <!-- Hover Action -->
                <div class="absolute inset-0 bg-blue-600/0 group-hover:bg-blue-600/5 transition-all duration-500 flex items-center justify-center">
                    <div class="translate-y-10 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">
                        <span class="text-[10px] font-black text-blue-600 uppercase tracking-widest bg-white px-4 py-2 rounded-full shadow-lg">Lihat Detail</span>
                    </div>
                </div>
            </div>

            <!-- Product Info -->
            <div class="space-y-4">
                <div class="flex justify-between items-start">
                    <h3 class="font-bold text-slate-800 text-lg leading-tight group-hover:text-blue-600 transition-colors">{{ $product->nama_produk }}</h3>
                    <div class="flex items-center gap-1">
                        <i data-lucide="star" class="w-3 h-3 fill-amber-400 text-amber-400"></i>
                        <span class="text-[10px] font-bold text-slate-400">4.9</span>
                    </div>
                </div>
                
                <p class="text-slate-400 text-xs font-medium line-clamp-2">{{ $product->deskripsi }}</p>
                <p class="text-[10px] font-black {{ $product->stok < 50 ? 'text-amber-500' : 'text-slate-500' }} uppercase tracking-widest">Stok: {{ $product->stok }} KG</p>

                <div class="flex items-center justify-between pt-4 border-t border-slate-50">
                    <div>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-1">Price</p>
                        <p class="text-xl font-extrabold text-slate-900">Rp{{ number_format($product->harga, 0, ',', '.') }}</p>
                    </div>
                    
                    <form action="{{ route('customer.cart.add', $product) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-14 h-14 bg-slate-50 text-slate-900 rounded-2xl flex items-center justify-center hover:bg-blue-600 hover:text-white hover:shadow-xl hover:shadow-blue-200 transition-all duration-300 active:scale-90">
                            <i data-lucide="plus" class="w-6 h-6"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-20 text-center">
            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <i data-lucide="search-x" class="w-10 h-10 text-slate-300"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-800">Produk tidak ditemukan</h3>
            <p class="text-slate-500 mt-2">Coba gunakan kata kunci atau filter lain.</p>
        </div>
        @endforelse
    </div>
</div>

<script>
    // Simulate loading for Skeleton Demonstration
    setTimeout(() => {
        document.getElementById('skeleton-grid').classList.add('hidden');
        document.getElementById('actual-content').classList.remove('hidden');
        lucide.createIcons(); // Refresh icons for new content
    }, 1200);
</script>
@endsection
