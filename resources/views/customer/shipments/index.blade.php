@extends('layouts.app')

@section('title', 'Pelacakan Pengiriman')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <h2 class="text-3xl font-black text-slate-800">Pelacakan <span class="text-indigo-600">Pengiriman</span></h2>
        <button onclick="openQrScanner()" class="px-6 py-2 bg-indigo-600 text-white rounded-xl font-bold flex items-center gap-2 hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-600/30">
            <i data-lucide="scan-line" class="w-5 h-5"></i> Scan QR Penerimaan
        </button>
    </div>

    <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/10">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">No. Resi / Surat Jalan</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">No. Pesanan</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Kurir / Logistik</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status Pengiriman</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Lacak</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($shipments as $shipment)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <p class="font-bold text-slate-800">{{ $shipment->suratJalan->no_surat_jalan ?? 'Belum Terbit' }}</p>
                            <p class="text-xs text-slate-400">{{ $shipment->suratJalan ? $shipment->suratJalan->tanggal_surat->format('d M Y') : 'Menunggu Jadwal' }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-500">ORD-{{ str_pad($shipment->pesanan_id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-slate-600">
                            {{ $shipment->kurir ?? 'Gudang Paramitra Pusat' }}
                        </td>
                        <td class="px-6 py-4">
                            @if($shipment->status_kirim == 'diterima')
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-600 border border-emerald-100 rounded-full text-[10px] font-bold uppercase tracking-widest">Terkirim</span>
                            @elseif($shipment->status_kirim == 'perjalanan')
                                <span class="px-3 py-1 bg-blue-50 text-blue-600 border border-blue-100 rounded-full text-[10px] font-bold uppercase tracking-widest flex items-center gap-1 w-max">
                                    <i data-lucide="loader" class="w-3 h-3 animate-spin"></i> Dalam Perjalanan
                                </span>
                            @else
                                <span class="px-3 py-1 bg-amber-50 text-amber-600 border border-amber-200 rounded-full text-[10px] font-bold uppercase tracking-widest flex items-center gap-1 w-max">
                                    <i data-lucide="package" class="w-3 h-3"></i> Siap Dikirim
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('customer.shipments.track', $shipment->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-600 hover:text-white transition-all text-sm font-bold">
                                <i data-lucide="map" class="w-4 h-4"></i> Lacak
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-400">Belum ada data pengiriman.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-6">
            {{ $shipments->links() }}
        </div>
    </div>
</div>

<!-- QR Scanner Modal -->
<div id="qrModal" class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4 opacity-0 transition-opacity duration-300">
    <div class="bg-white rounded-3xl w-full max-w-lg shadow-2xl overflow-hidden transform scale-95 transition-transform duration-300" id="qrModalContent">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-slate-50">
            <h3 class="font-bold text-slate-800 flex items-center gap-2">
                <i data-lucide="camera" class="w-5 h-5 text-indigo-600"></i> Scan Surat Jalan
            </h3>
            <button onclick="closeQrScanner()" class="w-8 h-8 flex items-center justify-center bg-slate-200 text-slate-600 rounded-full hover:bg-red-100 hover:text-red-600 transition-colors">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
        <div class="p-6">
            <div id="reader" class="w-full bg-slate-100 rounded-xl overflow-hidden border-2 border-dashed border-slate-300"></div>
            <p class="text-center text-sm text-slate-500 mt-4">Arahkan kamera ke QR Code yang ada di kertas Surat Jalan kurir.</p>
        </div>
    </div>
</div>

<script src="https://unpkg.com/html5-qrcode"></script>
<script>
    let html5QrcodeScanner = null;

    function openQrScanner() {
        const modal = document.getElementById('qrModal');
        const modalContent = document.getElementById('qrModalContent');
        
        modal.classList.remove('hidden');
        // trigger animation
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modalContent.classList.remove('scale-95');
        }, 10);

        if (!html5QrcodeScanner) {
            html5QrcodeScanner = new Html5QrcodeScanner("reader", { 
                fps: 10, 
                qrbox: {width: 250, height: 250},
                aspectRatio: 1.0,
            }, false);
        }

        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    }

    function closeQrScanner() {
        const modal = document.getElementById('qrModal');
        const modalContent = document.getElementById('qrModalContent');
        
        modal.classList.add('opacity-0');
        modalContent.classList.add('scale-95');
        
        if (html5QrcodeScanner) {
            html5QrcodeScanner.clear().catch(error => {
                console.error("Failed to clear html5QrcodeScanner. ", error);
            });
        }
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    function onScanSuccess(decodedText, decodedResult) {
        // Stop scanning
        if (html5QrcodeScanner) {
            html5QrcodeScanner.clear();
        }
        
        // Show loading state or direct redirect
        const readerDiv = document.getElementById('reader');
        readerDiv.innerHTML = `
            <div class="flex flex-col items-center justify-center h-64 bg-emerald-50 text-emerald-600">
                <i data-lucide="check-circle-2" class="w-16 h-16 mb-4"></i>
                <p class="font-bold">QR Berhasil Dibaca!</p>
                <p class="text-sm opacity-75">Mengarahkan ke halaman konfirmasi...</p>
            </div>
        `;
        lucide.createIcons();

        // Redirect to the scanned URL
        setTimeout(() => {
            window.location.href = decodedText;
        }, 1000);
    }

    function onScanFailure(error) {
        // handle scan failure, usually better to ignore and keep scanning
    }
</script>
@endsection
