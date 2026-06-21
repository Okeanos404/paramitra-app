@extends('layouts.app')

@section('title', 'Manajemen Pesanan')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Manajemen Pesanan</h2>
            <p class="text-slate-500 text-sm">Kelola pesanan pelanggan dan pantau status transaksi.</p>
        </div>
        <button onclick="toggleModal('modal-add-order')" class="bg-blue-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700 transition-all flex items-center gap-2 w-fit">
            <i data-lucide="shopping-cart" class="w-5 h-5"></i>
            Buat Pesanan
        </button>
    </div>

    <!-- Orders Table -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="px-6 py-4 text-sm font-semibold text-slate-600">ID Pesanan</th>
                        <th class="px-6 py-4 text-sm font-semibold text-slate-600">Pelanggan</th>
                        <th class="px-6 py-4 text-sm font-semibold text-slate-600">Tanggal</th>
                        <th class="px-6 py-4 text-sm font-semibold text-slate-600">Total Harga</th>
                        <th class="px-6 py-4 text-sm font-semibold text-slate-600">Status</th>
                        <th class="px-6 py-4 text-sm font-semibold text-slate-600">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($orders as $order)
                    <tr class="hover:bg-slate-50 transition-colors group">
                        <td class="px-6 py-4">
                            <span class="font-mono text-xs bg-slate-100 px-2 py-1 rounded text-slate-600">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-bold text-slate-800">{{ $order->user->name }}</p>
                            <p class="text-xs text-slate-400">{{ $order->user->email }}</p>
                        </td>
                        <td class="px-6 py-4 text-slate-600 text-sm">
                            {{ $order->tanggal_pesanan->format('d M Y, H:i') }}
                        </td>
                        <td class="px-6 py-4 font-semibold text-slate-800">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            @php
                                $statusClasses = [
                                    'pending' => 'bg-amber-50 text-amber-600 border-amber-100',
                                    'proses' => 'bg-blue-50 text-blue-600 border-blue-100',
                                    'kirim' => 'bg-indigo-50 text-indigo-600 border-indigo-100',
                                    'selesai' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                ];
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $statusClasses[$order->status] }} capitalize">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col gap-2">
                                <form action="{{ route('orders.updateStatus', $order) }}" method="POST" class="inline-flex items-center gap-2">
                                    @csrf
                                    <select name="status" onchange="this.form.submit()" class="text-xs bg-slate-50 border border-slate-200 rounded-lg p-1 outline-none focus:ring-2 focus:ring-blue-500 w-full">
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="proses" {{ $order->status === 'proses' ? 'selected' : '' }}>Proses</option>
                                        <option value="kirim" {{ $order->status === 'kirim' ? 'selected' : '' }}>Kirim</option>
                                        <option value="selesai" {{ $order->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                </form>

                                @if($order->payment_status === 'pending_payment')
                                <form action="{{ route('orders.approvePayment', $order) }}" method="POST">
                                    @csrf
                                    <button type="submit" onclick="return confirm('ACC pembayaran pesanan ini? Resi akan diterbitkan.')" class="w-full text-center px-3 py-1 bg-emerald-500 hover:bg-emerald-600 text-white text-[10px] font-bold rounded-lg uppercase tracking-widest transition-colors shadow-sm">
                                        ACC Bayar
                                    </button>
                                </form>
                                @elseif($order->payment_status === 'paid')
                                    @if($order->invoice)
                                        <a href="{{ route('invoices.show', $order->invoice->id) }}" class="w-full text-center px-3 py-1 bg-slate-800 hover:bg-slate-900 text-white text-[10px] font-bold rounded-lg uppercase tracking-widest transition-colors shadow-sm">
                                            Lihat Resi
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-500">Belum ada pesanan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Add Order -->
<div id="modal-add-order" class="fixed inset-0 z-[60] hidden overflow-y-auto">
    <div class="min-h-screen px-4 flex items-center justify-center">
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>
        <div class="relative bg-white w-full max-w-lg rounded-3xl shadow-2xl p-8 slide-in">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-xl font-bold text-slate-800">Buat Pesanan Baru</h3>
                <button onclick="toggleModal('modal-add-order')" class="text-slate-400 hover:text-slate-600">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>
            <form action="{{ route('orders.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Pilih Pelanggan</label>
                    <select name="user_id" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                        <option value="">-- Pilih Pelanggan --</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</p>
                        @endforeach
                    </select>
                </div>
                
                <div id="items-container" class="space-y-4">
                    <div class="item-row flex items-end gap-3">
                        <div class="flex-1">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Produk</label>
                            <select name="items[0][produk_id]" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                                <option value="">-- Pilih Produk --</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->nama_produk }} (Stok: {{ $product->stok }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-24">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Jumlah</label>
                            <input type="number" name="items[0][jumlah]" min="1" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                        </div>
                        <div class="w-12 flex justify-center">
                            <!-- Tombol hapus disembunyikan untuk baris pertama -->
                            <button type="button" class="remove-btn hidden p-3 bg-red-50 text-red-500 hover:bg-red-100 hover:text-red-600 rounded-xl transition-colors mb-[2px]">
                                <i data-lucide="trash-2" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex justify-start">
                    <button type="button" onclick="addItem()" class="text-sm font-bold text-blue-600 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
                        <i data-lucide="plus" class="w-4 h-4"></i> Tambah Produk Lain
                    </button>
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-xl shadow-lg hover:bg-blue-700 transition-all">Buat Pesanan</button>
            </form>
        </div>
    </div>
</div>

<script>
    let itemIndex = 1;

    function toggleModal(id) {
        const modal = document.getElementById(id);
        modal.classList.toggle('hidden');
    }

    function addItem() {
        const container = document.getElementById('items-container');
        const firstRow = container.querySelector('.item-row');
        const newRow = firstRow.cloneNode(true);

        // Update names to use the new index
        const selects = newRow.querySelectorAll('select');
        selects.forEach(select => {
            select.name = `items[${itemIndex}][produk_id]`;
            select.value = ''; // Reset selection
        });

        const inputs = newRow.querySelectorAll('input');
        inputs.forEach(input => {
            input.name = `items[${itemIndex}][jumlah]`;
            input.value = ''; // Reset value
        });

        // Tampilkan tombol hapus untuk baris baru
        const removeBtn = newRow.querySelector('.remove-btn');
        removeBtn.classList.remove('hidden');
        removeBtn.setAttribute('onclick', 'removeItem(this)');

        container.appendChild(newRow);
        itemIndex++;
        
        // Render lucide icons if defined
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    }

    function removeItem(button) {
        const row = button.closest('.item-row');
        row.remove();
    }
</script>
@endsection
