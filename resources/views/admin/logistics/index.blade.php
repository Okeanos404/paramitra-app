@extends('layouts.app')

@section('title', 'Manajemen Logistik')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Manajemen Logistik</h2>
            <p class="text-slate-500 text-sm">Pantau pengiriman barang dan update lokasi terkini.</p>
        </div>
        <button onclick="toggleModal('modal-add-shipment')" class="bg-indigo-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-indigo-700 transition-all flex items-center gap-2 w-fit">
            <i data-lucide="truck" class="w-5 h-5"></i>
            Proses Pengiriman
        </button>
    </div>

    <!-- Active Shipments -->
    <div class="grid grid-cols-1 gap-6">
        @forelse($shipments as $shipment)
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 hover:shadow-md transition-all">
            <div class="flex flex-col md:flex-row justify-between gap-6">
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <span class="px-3 py-1 bg-indigo-50 text-indigo-600 rounded-full text-xs font-bold border border-indigo-100">Resi: {{ $shipment->no_resi }}</span>
                        <span class="text-slate-400 text-xs">Pesanan #{{ $shipment->pesanan_id }}</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-800 text-lg">{{ $shipment->pesanan->user->name }}</h3>
                        <p class="text-slate-500 text-sm flex items-center gap-1">
                            <i data-lucide="map-pin" class="w-4 h-4"></i>
                            {{ $shipment->distribusi->last()->lokasi_terkini ?? 'Lokasi belum tersedia' }}
                        </p>
                    </div>
                    <div class="flex items-center gap-6">
                        <div class="flex items-center gap-2">
                            <i data-lucide="package" class="w-4 h-4 text-slate-400"></i>
                            <span class="text-sm text-slate-600">{{ $shipment->kurir }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i data-lucide="clock" class="w-4 h-4 text-slate-400"></i>
                            <span class="text-sm text-slate-600">{{ $shipment->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col justify-between items-end gap-4">
                    <span class="px-4 py-2 bg-slate-100 text-slate-600 rounded-xl text-sm font-bold capitalize">
                        Status: {{ $shipment->status_kirim }}
                    </span>
                    <button onclick="openTrackModal({{ $shipment }})" class="w-full md:w-auto px-6 py-2 bg-slate-800 text-white rounded-xl text-sm font-bold hover:bg-slate-900 transition-all">
                        Update Tracking
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-3xl border border-slate-100 p-12 text-center text-slate-500">
            Belum ada data pengiriman.
        </div>
        @endforelse
    </div>
</div>

<!-- Modal Add Shipment -->
<div id="modal-add-shipment" class="fixed inset-0 z-[60] hidden overflow-y-auto">
    <div class="min-h-screen px-4 flex items-center justify-center">
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>
        <div class="relative bg-white w-full max-w-lg rounded-3xl shadow-2xl p-8 slide-in">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-xl font-bold text-slate-800">Proses Pengiriman Baru</h3>
                <button onclick="toggleModal('modal-add-shipment')" class="text-slate-400 hover:text-slate-600">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>
            <form action="{{ route('logistics.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Pilih Pesanan (Siap Dikirim)</label>
                    <select name="pesanan_id" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                        <option value="">-- Pilih Pesanan --</option>
                        @foreach($pending_orders as $order)
                            <option value="{{ $order->id }}">#ORD-{{ $order->id }} - {{ $order->user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Kurir / Armada</label>
                    <select name="kurir" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                        <option value="Truck Hino Wingbox B 9021 PYA">Truck Hino Wingbox B 9021 PYA (Armada Wingbox Utama)</option>
                        <option value="Truck Mitsubishi Fuso B 9452 PTW">Truck Mitsubishi Fuso B 9452 PTW (Armada Fuso Medium)</option>
                        <option value="Box Isuzu Elf B 9188 PPA">Box Isuzu Elf B 9188 PPA (Armada Box Cepat)</option>
                    </select>
                </div>
                <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 px-4 rounded-xl shadow-lg hover:bg-indigo-700 transition-all">Mulai Pengiriman</button>
            </form>
        </div>
    </div>
</div>

<!-- Modal Update Tracking (Dynamic) -->
<div id="modal-update-track" class="fixed inset-0 z-[60] hidden overflow-y-auto">
    <div class="min-h-screen px-4 flex items-center justify-center">
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>
        <div class="relative bg-white w-full max-w-lg rounded-3xl shadow-2xl p-8 slide-in">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-xl font-bold text-slate-800">Update Lokasi Pengiriman</h3>
                <button onclick="toggleModal('modal-update-track')" class="text-slate-400 hover:text-slate-600">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>
            <form id="form-update-track" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Kurir / Armada</label>
                    <select name="kurir" id="edit-kurir" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                        <option value="Truck Hino Wingbox B 9021 PYA">Truck Hino Wingbox B 9021 PYA (Armada Wingbox Utama)</option>
                        <option value="Truck Mitsubishi Fuso B 9452 PTW">Truck Mitsubishi Fuso B 9452 PTW (Armada Fuso Medium)</option>
                        <option value="Box Isuzu Elf B 9188 PPA">Box Isuzu Elf B 9188 PPA (Armada Box Cepat)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Lokasi Terkini</label>
                    <input type="text" name="lokasi_terkini" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Status Pengiriman</label>
                    <select name="status_kirim" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                        <option value="gudang">Di Gudang</option>
                        <option value="perjalanan">Dalam Perjalanan</option>
                        <option value="diterima">Telah Diterima</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Catatan</label>
                    <textarea name="catatan" rows="2" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 transition-all"></textarea>
                </div>
                <button type="submit" class="w-full bg-slate-800 text-white font-bold py-3 px-4 rounded-xl shadow-lg hover:bg-slate-900 transition-all">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleModal(id) {
        const modal = document.getElementById(id);
        modal.classList.toggle('hidden');
    }

    function openTrackModal(shipment) {
        const form = document.getElementById('form-update-track');
        form.action = `/admin/logistics/${shipment.id}/track`;
        document.getElementById('edit-kurir').value = shipment.kurir;
        toggleModal('modal-update-track');
    }
</script>
@endsection
