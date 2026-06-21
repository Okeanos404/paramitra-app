@extends('layouts.app')

@section('title', 'Detail Purchase Order')

@section('content')
<div class="space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('purchase-orders.index') }}" class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-full transition-colors">
            <i data-lucide="arrow-left" class="w-6 h-6"></i>
        </a>
        <h2 class="text-3xl font-black text-slate-800">Detail <span class="text-indigo-600">PO Supplier</span></h2>
    </div>

    <!-- Info Card -->
    <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/10 grid grid-cols-1 md:grid-cols-2 gap-8">
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Informasi PO</p>
            <p class="text-2xl font-black text-slate-800">{{ $purchaseOrder->po_number }}</p>
            <div class="mt-4 space-y-2">
                <p class="text-sm font-bold text-slate-600">Tanggal PO: <span class="text-slate-500 font-medium">{{ \Carbon\Carbon::parse($purchaseOrder->tanggal_po)->format('d M Y') }}</span></p>
                <p class="text-sm font-bold text-slate-600">Estimasi Tiba: <span class="text-slate-500 font-medium">{{ \Carbon\Carbon::parse($purchaseOrder->tanggal_kirim_diharapkan)->format('d M Y') }}</span></p>
                <div class="flex items-center gap-2 mt-2">
                    <span class="text-sm font-bold text-slate-600">Status:</span>
                    @if($purchaseOrder->status === 'pending_approval')
                        <span class="px-3 py-1 bg-fuchsia-50 text-fuchsia-600 border border-fuchsia-100 rounded-full text-[10px] font-bold uppercase tracking-widest flex items-center gap-1 w-max"><i data-lucide="clock" class="w-3 h-3"></i> Menunggu Approval</span>
                    @elseif($purchaseOrder->status === 'approved')
                        <span class="px-3 py-1 bg-violet-50 text-violet-600 border border-violet-100 rounded-full text-[10px] font-bold uppercase tracking-widest flex items-center gap-1 w-max"><i data-lucide="check-circle" class="w-3 h-3"></i> Disetujui Manager</span>
                    @elseif($purchaseOrder->status === 'draft')
                        <span class="px-3 py-1 bg-slate-100 text-slate-600 border border-slate-200 rounded-full text-[10px] font-bold uppercase tracking-widest">Draft</span>
                    @elseif($purchaseOrder->status === 'rejected')
                        <span class="px-3 py-1 bg-red-50 text-red-600 border border-red-100 rounded-full text-[10px] font-bold uppercase tracking-widest flex items-center gap-1 w-max"><i data-lucide="x-circle" class="w-3 h-3"></i> Ditolak</span>
                    @elseif($purchaseOrder->status === 'sent')
                        <span class="px-3 py-1 bg-blue-50 text-blue-600 border border-blue-100 rounded-full text-[10px] font-bold uppercase tracking-widest">Terkirim</span>
                    @elseif($purchaseOrder->status === 'confirmed')
                        <span class="px-3 py-1 bg-indigo-50 text-indigo-600 border border-indigo-100 rounded-full text-[10px] font-bold uppercase tracking-widest">Disetujui Supplier</span>
                    @elseif($purchaseOrder->status === 'partial_received')
                        <span class="px-3 py-1 bg-orange-50 text-orange-600 border border-orange-100 rounded-full text-[10px] font-bold uppercase tracking-widest">Diterima Sebagian</span>
                    @elseif($purchaseOrder->status === 'received')
                        <span class="px-3 py-1 bg-emerald-50 text-emerald-600 border border-emerald-100 rounded-full text-[10px] font-bold uppercase tracking-widest">Diterima Lengkap</span>
                    @endif
                </div>
            </div>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Informasi Supplier</p>
            <p class="text-xl font-bold text-indigo-600">{{ optional($purchaseOrder->supplier)->nama_supplier ?? '-' }}</p>
            <div class="mt-4 space-y-2 text-sm text-slate-500">
                <p><i data-lucide="mail" class="w-4 h-4 inline mr-2 text-slate-400"></i> {{ optional($purchaseOrder->supplier)->email ?? '-' }}</p>
                <p><i data-lucide="map-pin" class="w-4 h-4 inline mr-2 text-slate-400"></i> {{ optional($purchaseOrder->supplier)->negara ?? '-' }}</p>
            </div>
            @if($purchaseOrder->notes)
            <div class="mt-4 p-4 bg-slate-50 rounded-xl border border-slate-100">
                <p class="text-xs font-bold text-slate-500 mb-1">Catatan Tambahan:</p>
                <p class="text-sm text-slate-600">{{ $purchaseOrder->notes }}</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Manager Actions -->
    @if(Auth::user()->role === 'manajemen' && $purchaseOrder->status === 'pending_approval')
    <div class="bg-indigo-50 rounded-[2rem] p-6 border border-indigo-100 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div>
            <h3 class="text-lg font-black text-indigo-900">Otorisasi Pembelian</h3>
            <p class="text-sm text-indigo-700">Periksa detail barang di bawah sebelum memberikan persetujuan.</p>
        </div>
        <div class="flex items-center gap-4">
            <form action="{{ route('purchase-orders.reject', $purchaseOrder->id) }}" method="POST">
                @csrf
                <button type="submit" onclick="return confirm('Tolak Purchase Order ini?')" class="px-6 py-3 bg-white text-red-600 rounded-xl font-bold hover:bg-red-50 hover:text-red-700 border border-red-200 transition-colors shadow-sm">
                    Tolak PO
                </button>
            </form>
            <form action="{{ route('purchase-orders.approve', $purchaseOrder->id) }}" method="POST">
                @csrf
                <button type="submit" onclick="return confirm('Setujui Purchase Order ini untuk dilanjutkan?')" class="px-6 py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-600/30 flex items-center gap-2">
                    <i data-lucide="check-circle" class="w-5 h-5"></i> Setujui PO
                </button>
            </form>
        </div>
    </div>
    @endif

    <!-- Admin Actions -->
    @if(Auth::user()->role === 'admin')
        @if($purchaseOrder->status === 'approved' || $purchaseOrder->status === 'draft')
        <div class="bg-blue-50 rounded-[2rem] p-6 border border-blue-100 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div>
                <h3 class="text-lg font-black text-blue-900">PO Siap Dikirim</h3>
                <p class="text-sm text-blue-700">PO telah disetujui Manager. Kirim ke supplier sekarang.</p>
            </div>
            <form action="{{ route('purchase-orders.send', $purchaseOrder->id) }}" method="POST">
                @csrf
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition-colors flex items-center gap-2 shadow-lg shadow-blue-600/30">
                    <i data-lucide="send" class="w-5 h-5"></i> Kirim PO ke Supplier
                </button>
            </form>
        </div>
        @elseif($purchaseOrder->status === 'sent')
        <div class="bg-emerald-50 rounded-[2rem] p-6 border border-emerald-100 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div>
                <h3 class="text-lg font-black text-emerald-900">Konfirmasi Supplier</h3>
                <p class="text-sm text-emerald-700">Tandai jika supplier telah menyetujui pesanan ini.</p>
            </div>
            <form action="{{ route('purchase-orders.confirm', $purchaseOrder->id) }}" method="POST">
                @csrf
                <button type="submit" class="px-6 py-3 bg-emerald-600 text-white rounded-xl font-bold hover:bg-emerald-700 transition-colors flex items-center gap-2 shadow-lg shadow-emerald-600/30">
                    <i data-lucide="check" class="w-5 h-5"></i> Supplier Setuju
                </button>
            </form>
        </div>
        @elseif($purchaseOrder->status === 'confirmed' || $purchaseOrder->status === 'partial_received')
        <div class="bg-teal-50 rounded-[2rem] p-6 border border-teal-100 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div>
                <h3 class="text-lg font-black text-teal-900">Penerimaan Barang</h3>
                <p class="text-sm text-teal-700">Barang dari supplier siap diterima dan dimasukkan ke dalam stok gudang.</p>
            </div>
            <a href="{{ route('goods-receipt.create', $purchaseOrder->id) }}" class="px-6 py-3 bg-teal-600 text-white rounded-xl font-bold hover:bg-teal-700 transition-colors flex items-center gap-2 shadow-lg shadow-teal-600/30">
                <i data-lucide="package-plus" class="w-5 h-5"></i> Terima Barang Fisik
            </a>
        </div>
        @endif
    @endif

    <!-- Item List -->
    <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/10">
        <h3 class="text-xl font-black text-slate-800 mb-6">Daftar <span class="text-indigo-600">Barang</span></h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest rounded-l-2xl">Produk</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Harga Satuan</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Jumlah</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest rounded-r-2xl text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($purchaseOrder->items as $item)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <p class="font-bold text-slate-700">{{ optional($item->produk)->nama_produk ?? 'Produk Dihapus' }}</p>
                        </td>
                        <td class="px-6 py-4 text-right font-medium text-slate-600">
                            Rp{{ number_format($item->harga_satuan, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center font-bold text-indigo-600 bg-indigo-50/30">
                            {{ $item->jumlah }}
                        </td>
                        <td class="px-6 py-4 text-right font-black text-slate-800">
                            Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="px-6 py-6 text-right font-bold text-slate-600 uppercase tracking-widest text-sm">Total Nilai PO</td>
                        <td class="px-6 py-6 text-right font-black text-2xl text-indigo-600">Rp{{ number_format($purchaseOrder->total_amount, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Goods Receipt History -->
    @if($purchaseOrder->goodsReceipts->count() > 0)
    <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/10">
        <h3 class="text-xl font-black text-slate-800 mb-6">Histori <span class="text-teal-600">Penerimaan Barang</span></h3>
        <div class="space-y-4">
            @foreach($purchaseOrder->goodsReceipts as $receipt)
            <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100 flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-teal-100 text-teal-600 rounded-xl flex items-center justify-center shrink-0">
                        <i data-lucide="package-check" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <p class="font-black text-slate-800">{{ $receipt->nomor_penerimaan }}</p>
                        <p class="text-sm font-bold text-slate-500">Diterima pada: <span class="text-slate-700">{{ \Carbon\Carbon::parse($receipt->tanggal_terima)->format('d M Y, H:i') }}</span></p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="px-3 py-1 bg-teal-50 text-teal-600 border border-teal-100 rounded-full text-[10px] font-bold uppercase tracking-widest inline-block mb-2">Tercatat di Gudang</span>
                    @if($receipt->catatan)
                        <p class="text-xs font-medium text-slate-500 italic">"{{ $receipt->catatan }}"</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
