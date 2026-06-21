@extends('layouts.app')

@section('title', 'Lacak Pengiriman')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <div class="flex items-center justify-between">
        <a href="{{ route('customer.shipments.index') }}" class="flex items-center gap-2 text-slate-500 hover:text-indigo-600 transition-colors font-bold text-sm">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Daftar Pengiriman
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] p-12 border border-slate-100 shadow-xl shadow-slate-200/10">
        <div class="text-center mb-12">
            <div class="w-20 h-20 bg-indigo-50 rounded-3xl flex items-center justify-center text-indigo-600 mx-auto mb-6">
                <i data-lucide="map" class="w-10 h-10"></i>
            </div>
            <h1 class="text-3xl font-black text-slate-800 mb-2">Live Tracking</h1>
            <p class="text-slate-500">No. Pesanan: ORD-{{ str_pad($shipment->pesanan_id, 5, '0', STR_PAD_LEFT) }}</p>
        </div>

        <div class="relative py-8">
            <!-- Timeline Line -->
            <div class="absolute left-8 top-0 bottom-0 w-1 bg-slate-100 rounded-full"></div>

            <div class="space-y-12">
                <!-- Step 1 -->
                <div class="relative flex gap-8">
                    <div class="w-16 h-16 bg-emerald-500 rounded-2xl flex items-center justify-center text-white shrink-0 z-10 shadow-lg shadow-emerald-500/30">
                        <i data-lucide="package-check" class="w-8 h-8"></i>
                    </div>
                    <div class="pt-2">
                        <p class="text-[10px] font-black text-emerald-500 uppercase tracking-widest mb-1">Tahap 1</p>
                        <h4 class="text-lg font-bold text-slate-800">Pesanan Diterima</h4>
                        <p class="text-sm text-slate-500 mt-1">PT Paramitra Praya Prawatya telah memproses pesanan Anda.</p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="relative flex gap-8">
                    <div class="w-16 h-16 {{ $shipment->status_kirim == 'perjalanan' || $shipment->status_kirim == 'diterima' ? 'bg-blue-500 shadow-blue-500/30 text-white' : 'bg-slate-100 text-slate-300' }} rounded-2xl flex items-center justify-center shrink-0 z-10 shadow-lg transition-colors">
                        <i data-lucide="truck" class="w-8 h-8"></i>
                    </div>
                    <div class="pt-2">
                        <p class="text-[10px] font-black {{ $shipment->status_kirim == 'perjalanan' || $shipment->status_kirim == 'diterima' ? 'text-blue-500' : 'text-slate-400' }} uppercase tracking-widest mb-1">Tahap 2</p>
                        <h4 class="text-lg font-bold text-slate-800">Dalam Perjalanan</h4>
                        <p class="text-sm text-slate-500 mt-1">
                            @if($shipment->status_kirim == 'perjalanan' || $shipment->status_kirim == 'diterima')
                                Bahan kimia sedang dalam perjalanan menggunakan armada distribusi kami.
                            @else
                                Menunggu armada distribusi.
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="relative flex gap-8">
                    <div class="w-16 h-16 {{ $shipment->status_kirim == 'diterima' ? 'bg-indigo-500 shadow-indigo-500/30 text-white' : 'bg-slate-100 text-slate-300' }} rounded-2xl flex items-center justify-center shrink-0 z-10 shadow-lg transition-colors">
                        <i data-lucide="home" class="w-8 h-8"></i>
                    </div>
                    <div class="pt-2">
                        <p class="text-[10px] font-black {{ $shipment->status_kirim == 'diterima' ? 'text-indigo-500' : 'text-slate-400' }} uppercase tracking-widest mb-1">Tahap 3</p>
                        <h4 class="text-lg font-bold text-slate-800">Tiba di Tujuan</h4>
                        <p class="text-sm text-slate-500 mt-1">
                            @if($shipment->status_kirim == 'diterima')
                                Pesanan telah tiba di fasilitas produksi Anda dan Surat Jalan telah ditandatangani.
                            @else
                                Estimasi tiba sesuai jadwal pengiriman logistik.
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
