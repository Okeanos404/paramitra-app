@extends('layouts.app')

@section('title', 'Cetak Surat Jalan')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    
    <div class="flex items-center justify-between no-print">
        <a href="{{ route('surat-jalan.index') }}" class="flex items-center gap-2 text-slate-500 hover:text-slate-800 transition-colors">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
            <span class="font-bold">Kembali</span>
        </a>
        <button onclick="window.print()" class="bg-blue-600 text-white px-6 py-2 rounded-xl font-bold hover:bg-blue-700 flex items-center gap-2 shadow-sm">
            <i data-lucide="printer" class="w-4 h-4"></i>
            Cetak Surat Jalan
        </button>
    </div>

    <!-- Print Area -->
    <div class="bg-white p-12 rounded-2xl shadow-sm border border-slate-200 print:shadow-none print:border-none print:p-0" id="print-area">
        
        <!-- Header -->
        <div class="flex justify-between items-start border-b-2 border-slate-800 pb-6 mb-8">
            <div class="flex items-center gap-4">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-16 h-16 object-contain">
                <div>
                    <h1 class="text-2xl font-black text-slate-900 uppercase tracking-tight">PT Paramitra Praya Prawatya</h1>
                    <p class="text-sm text-slate-600">Pergudangan Bizpark I Pulo Gadung Blok A6 No. 2-6<br>Jakarta Timur, 13920 - (021) 29368791</p>
                </div>
            </div>
            <div class="text-right">
                <h2 class="text-3xl font-black text-slate-800 uppercase tracking-widest mb-2">Surat Jalan</h2>
                <p class="font-mono text-lg font-bold text-slate-600">{{ $suratJalan->no_surat_jalan }}</p>
            </div>
        </div>

        <!-- Info Grid -->
        <div class="grid grid-cols-2 gap-12 mb-8">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Dikirim Kepada:</p>
                <p class="font-bold text-slate-800 text-lg">{{ $suratJalan->pengiriman->pesanan->user->name }}</p>
                <p class="text-slate-600 mt-1">{{ $suratJalan->penerima_nama }}</p>
                <p class="text-slate-600 mt-1 max-w-xs">{{ $suratJalan->alamat_pengiriman }}</p>
            </div>
            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase mb-1">Tanggal</p>
                        <p class="font-bold text-slate-800">{{ $suratJalan->tanggal_surat->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase mb-1">No. Resi Kirim</p>
                        <p class="font-bold text-slate-800">{{ $suratJalan->pengiriman->no_resi }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase mb-1">No. Pesanan</p>
                        <p class="font-bold text-slate-800">#ORD-{{ str_pad($suratJalan->pengiriman->pesanan_id, 5, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase mb-1">Armada / Kurir</p>
                        <p class="font-bold text-slate-800">{{ $suratJalan->pengiriman->kurir }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Item Table -->
        <table class="w-full text-left mb-8 border-collapse">
            <thead>
                <tr class="border-b-2 border-slate-200">
                    <th class="py-3 font-bold text-slate-800 uppercase text-xs tracking-widest w-12">No</th>
                    <th class="py-3 font-bold text-slate-800 uppercase text-xs tracking-widest">Deskripsi Produk</th>
                    <th class="py-3 font-bold text-slate-800 uppercase text-xs tracking-widest text-center w-32">Kuantitas</th>
                    <th class="py-3 font-bold text-slate-800 uppercase text-xs tracking-widest text-center w-32">Satuan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($suratJalan->pengiriman->pesanan->detailPesanan as $index => $detail)
                <tr>
                    <td class="py-4 text-slate-600">{{ $index + 1 }}</td>
                    <td class="py-4 font-bold text-slate-800">{{ $detail->produk->nama_produk }}</td>
                    <td class="py-4 text-center font-bold text-slate-800">{{ $detail->jumlah }}</td>
                    <td class="py-4 text-center text-slate-600">Unit</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if($suratJalan->catatan_khusus)
        <div class="mb-12 border-l-4 border-blue-500 pl-4 py-1">
            <p class="text-xs font-bold text-slate-400 uppercase mb-1">Catatan Khusus</p>
            <p class="text-slate-800">{{ $suratJalan->catatan_khusus }}</p>
        </div>
        @endif

        <!-- Footer Signatures & QR -->
        <div class="flex justify-between items-end mt-16 pt-8 border-t border-slate-200">
            <!-- QR Code Section -->
            <div class="text-center bg-white p-4 border-2 border-dashed border-slate-300 rounded-xl">
                @php
                    $confirmUrl = route('customer.shipments.confirmReceipt', $suratJalan->pengiriman_id);
                @endphp
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data={{ urlencode($confirmUrl) }}" alt="QR Code Konfirmasi" class="mx-auto mb-2 w-24 h-24">
                <p class="text-[10px] font-bold text-slate-600 uppercase tracking-widest">Scan untuk</p>
                <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest">Konfirmasi Terima</p>
            </div>

            <!-- Signatures -->
            <div class="flex gap-16">
                <div class="text-center">
                    <p class="text-sm font-bold text-slate-800 mb-20">Pengirim / Supir</p>
                    <div class="border-b border-slate-800 w-40 mb-2"></div>
                    <p class="text-xs text-slate-500">Tanda Tangan & Nama</p>
                </div>
                <div class="text-center">
                    <p class="text-sm font-bold text-slate-800 mb-20">Penerima</p>
                    <div class="border-b border-slate-800 w-40 mb-2"></div>
                    <p class="text-xs text-slate-500">Tanda Tangan & Nama Jelas</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Print Styling Helper -->
    <style>
        @media print {
            body { background: white; }
            .no-print { display: none !important; }
            #sidebar, header, footer { display: none !important; }
            main { margin: 0 !important; padding: 0 !important; }
        }
    </style>
</div>
@endsection
