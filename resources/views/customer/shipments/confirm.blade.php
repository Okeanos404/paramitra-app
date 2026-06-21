@extends('layouts.app')

@section('title', 'Konfirmasi Penerimaan Barang')

@section('content')
<div class="max-w-xl mx-auto py-8">
    <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-xl text-center">
        
        <div class="w-20 h-20 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-6">
            <i data-lucide="package-check" class="w-10 h-10 text-emerald-500"></i>
        </div>

        <h2 class="text-2xl font-black text-slate-800 mb-2">Konfirmasi Barang Diterima</h2>
        <p class="text-slate-500 mb-8">Anda akan mengonfirmasi bahwa barang untuk pesanan ini telah Anda terima dalam kondisi baik.</p>

        <div class="bg-slate-50 rounded-2xl p-6 text-left mb-8 space-y-4">
            <div class="flex justify-between items-center pb-4 border-b border-slate-200">
                <span class="text-sm font-bold text-slate-500 uppercase">No. Resi</span>
                <span class="font-bold text-slate-800">{{ $shipment->no_resi }}</span>
            </div>
            <div class="flex justify-between items-center pb-4 border-b border-slate-200">
                <span class="text-sm font-bold text-slate-500 uppercase">Kurir</span>
                <span class="font-bold text-slate-800">{{ $shipment->kurir }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-sm font-bold text-slate-500 uppercase">Surat Jalan</span>
                <span class="font-bold text-slate-800">{{ $shipment->suratJalan->no_surat_jalan ?? '-' }}</span>
            </div>
        </div>

        <form action="{{ route('customer.shipments.confirm', $shipment) }}" method="POST">
            @csrf
            <button type="submit" onclick="return confirm('Apakah Anda yakin barang sudah diterima dengan baik?')" class="w-full bg-emerald-600 text-white font-bold py-4 rounded-xl hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-200 flex items-center justify-center gap-2">
                <i data-lucide="check-circle" class="w-5 h-5"></i>
                Ya, Barang Telah Diterima
            </button>
        </form>

        <p class="text-xs text-slate-400 mt-6 mt-4"><i data-lucide="shield-check" class="w-3 h-3 inline mr-1"></i>Dengan menekan tombol di atas, status pesanan akan diselesaikan dan kurir dapat meninggalkan lokasi.</p>
    </div>
</div>
@endsection
