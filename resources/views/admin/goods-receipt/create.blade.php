@extends('layouts.app')

@section('title', 'Penerimaan Barang Fisik')

@section('content')
<div class="space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('purchase-orders.show', $purchaseOrder->id) }}" class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-full transition-colors">
            <i data-lucide="arrow-left" class="w-6 h-6"></i>
        </a>
        <h2 class="text-3xl font-black text-slate-800">Terima <span class="text-teal-600">Barang PO</span></h2>
    </div>

    <!-- Info PO -->
    <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Nomor PO</p>
                <p class="text-xl font-black text-slate-800">{{ $purchaseOrder->po_number }}</p>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Supplier</p>
                <p class="text-xl font-bold text-indigo-600">{{ optional($purchaseOrder->supplier)->nama_supplier ?? '-' }}</p>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Status PO</p>
                <span class="px-3 py-1 bg-indigo-50 text-indigo-600 border border-indigo-100 rounded-full text-[10px] font-bold uppercase tracking-widest inline-block mt-1">Disetujui Supplier</span>
            </div>
        </div>
    </div>

    <form action="{{ route('goods-receipt.store', $purchaseOrder->id) }}" method="POST" class="space-y-8">
        @csrf

        <!-- Detail Penerimaan -->
        <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/10 grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Lokasi Penyimpanan</label>
                <div class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-500 font-medium cursor-not-allowed">
                    @if($gudangs->count() > 0)
                        {{ $gudangs->first()->nama_gudang }} (Otomatis dialokasikan)
                        <input type="hidden" name="gudang_id" value="{{ $gudangs->first()->id }}">
                    @else
                        Sistem Sedang Menyiapkan Gudang...
                    @endif
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Catatan Penerimaan (Kondisi Truk/Cuaca)</label>
                <textarea name="catatan" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition-all text-slate-600 font-medium placeholder:text-slate-300" placeholder="Opsional..."></textarea>
                @error('catatan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Daftar Pengecekan Barang Fisik -->
        <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/10">
            <h3 class="text-xl font-black text-slate-800 mb-6">Pengecekan <span class="text-teal-600">Fisik Barang</span></h3>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-4 py-3 text-[10px] font-black text-slate-400 uppercase tracking-widest rounded-l-2xl">Produk (Berdasarkan PO)</th>
                            <th class="px-4 py-3 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Jumlah Dipesan</th>
                            <th class="px-4 py-3 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Jumlah Bagus (Diterima)</th>
                            <th class="px-4 py-3 text-[10px] font-black text-slate-400 uppercase tracking-widest rounded-r-2xl text-center">Jumlah Cacat (Reject)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($purchaseOrder->items as $index => $item)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-4 py-4">
                                <input type="hidden" name="items[{{ $index }}][purchase_order_item_id]" value="{{ $item->id }}">
                                <p class="font-bold text-slate-700">{{ optional($item->produk)->nama_produk ?? 'Produk Dihapus' }}</p>
                                <p class="text-xs text-slate-400 mt-1">Harap hitung dengan teliti.</p>
                            </td>
                            <td class="px-4 py-4 text-center">
                                <span class="px-4 py-2 bg-slate-100 text-slate-600 rounded-lg font-black text-sm">{{ $item->jumlah }}</span>
                            </td>
                            <td class="px-4 py-4">
                                <input type="number" name="items[{{ $index }}][jumlah_terima]" required min="0" value="{{ $item->jumlah }}" class="w-full px-3 py-3 rounded-lg border border-slate-200 focus:border-teal-500 outline-none text-sm font-black text-center text-teal-600 bg-teal-50/30">
                            </td>
                            <td class="px-4 py-4">
                                <input type="number" name="items[{{ $index }}][jumlah_reject]" required min="0" value="0" class="w-full px-3 py-3 rounded-lg border border-slate-200 focus:border-red-500 outline-none text-sm font-black text-center text-red-600 bg-red-50/30">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-8 flex justify-end">
                <button type="submit" onclick="return confirm('Apakah Anda yakin jumlah yang dihitung sudah benar? Stok akan otomatis bertambah ke Gudang.')" class="px-8 py-4 bg-teal-600 text-white rounded-2xl font-bold hover:bg-teal-700 transition-colors flex items-center gap-2 shadow-xl shadow-teal-600/30">
                    <i data-lucide="package-check" class="w-5 h-5"></i> Simpan & Update Stok
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
