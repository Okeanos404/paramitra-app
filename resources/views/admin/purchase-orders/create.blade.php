@extends('layouts.app')

@section('title', 'Buat Purchase Order Baru')

@section('content')
<div class="space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('purchase-orders.index') }}" class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-full transition-colors">
            <i data-lucide="arrow-left" class="w-6 h-6"></i>
        </a>
        <h2 class="text-3xl font-black text-slate-800">Buat <span class="text-indigo-600">PO Baru</span></h2>
    </div>

    <form action="{{ route('purchase-orders.store') }}" method="POST" class="space-y-8">
        @csrf
        
        <!-- Main Info -->
        <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/10 grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Pilih Supplier <span class="text-red-500">*</span></label>
                <select name="supplier_id" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition-all text-slate-600 font-medium">
                    <option value="">-- Pilih Supplier --</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                    @endforeach
                </select>
                @error('supplier_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Estimasi Tiba <span class="text-red-500">*</span></label>
                <input type="date" name="tanggal_kirim_diharapkan" required min="{{ date('Y-m-d') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition-all text-slate-600 font-medium">
                @error('tanggal_kirim_diharapkan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-slate-700 mb-2">Catatan Tambahan</label>
                <textarea name="notes" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition-all text-slate-600 font-medium placeholder:text-slate-300" placeholder="Opsional..."></textarea>
                @error('notes') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Items -->
        <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/10">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-black text-slate-800">Daftar <span class="text-indigo-600">Barang</span></h3>
                <button type="button" onclick="addItem()" class="px-4 py-2 bg-indigo-50 text-indigo-600 rounded-xl font-bold flex items-center gap-2 hover:bg-indigo-100 transition-colors">
                    <i data-lucide="plus" class="w-4 h-4"></i> Tambah Baris
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left" id="itemsTable">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-4 py-3 text-[10px] font-black text-slate-400 uppercase tracking-widest rounded-l-2xl w-2/5">Produk</th>
                            <th class="px-4 py-3 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center w-1/6">Jumlah</th>
                            <th class="px-4 py-3 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right w-1/5">Harga Satuan (Rp)</th>
                            <th class="px-4 py-3 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right w-1/5">Subtotal (Rp)</th>
                            <th class="px-4 py-3 text-[10px] font-black text-slate-400 uppercase tracking-widest rounded-r-2xl text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50" id="itemsBody">
                        <tr class="item-row">
                            <td class="px-4 py-3">
                                <select name="items[0][produk_id]" onchange="updatePrice(this)" required class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:border-indigo-500 outline-none text-sm font-medium">
                                    <option value="" data-harga="">-- Pilih Produk --</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" data-harga="{{ $product->harga_pokok ?? $product->harga }}">{{ $product->nama_produk }} (Stok: {{ $product->stok }})</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-4 py-3">
                                <input type="number" name="items[0][jumlah]" required min="1" value="1" oninput="calculateSubtotal(this)" class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:border-indigo-500 outline-none text-sm font-bold text-center text-indigo-600 bg-indigo-50/30">
                            </td>
                            <td class="px-4 py-3">
                                <input type="number" name="items[0][harga_satuan]" required readonly class="w-full px-3 py-2 rounded-lg border border-slate-200 bg-slate-50 outline-none text-sm font-medium text-right text-slate-500 cursor-not-allowed">
                            </td>
                            <td class="px-4 py-3">
                                <input type="text" readonly class="subtotal-input w-full px-3 py-2 rounded-lg border border-transparent bg-transparent outline-none text-sm font-black text-right text-slate-800" value="0">
                            </td>
                            <td class="px-4 py-3 text-center">
                                <button type="button" onclick="removeItem(this)" class="p-2 text-slate-300 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="px-4 py-4 text-right text-xs font-bold text-slate-400 uppercase tracking-widest">Total Keseluruhan</td>
                            <td class="px-4 py-4 text-right font-black text-xl text-indigo-600" id="grandTotal">Rp 0</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit" class="px-8 py-4 bg-indigo-600 text-white rounded-2xl font-bold hover:bg-indigo-700 transition-colors flex items-center gap-2 shadow-xl shadow-indigo-600/30">
                    <i data-lucide="save" class="w-5 h-5"></i> Simpan & Kirim ke Manager
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Template for new rows -->
<template id="rowTemplate">
    <tr class="item-row">
        <td class="px-4 py-3">
            <select name="items[INDEX][produk_id]" onchange="updatePrice(this)" required class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:border-indigo-500 outline-none text-sm font-medium">
                <option value="" data-harga="">-- Pilih Produk --</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" data-harga="{{ $product->harga_pokok ?? $product->harga }}">{{ $product->nama_produk }} (Stok: {{ $product->stok }})</option>
                @endforeach
            </select>
        </td>
        <td class="px-4 py-3">
            <input type="number" name="items[INDEX][jumlah]" required min="1" value="1" oninput="calculateSubtotal(this)" class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:border-indigo-500 outline-none text-sm font-bold text-center text-indigo-600 bg-indigo-50/30">
        </td>
        <td class="px-4 py-3">
            <input type="number" name="items[INDEX][harga_satuan]" required readonly class="w-full px-3 py-2 rounded-lg border border-slate-200 bg-slate-50 outline-none text-sm font-medium text-right text-slate-500 cursor-not-allowed">
        </td>
        <td class="px-4 py-3">
            <input type="text" readonly class="subtotal-input w-full px-3 py-2 rounded-lg border border-transparent bg-transparent outline-none text-sm font-black text-right text-slate-800" value="0">
        </td>
        <td class="px-4 py-3 text-center">
            <button type="button" onclick="removeItem(this)" class="p-2 text-slate-300 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                <i data-lucide="trash-2" class="w-4 h-4"></i>
            </button>
        </td>
    </tr>
</template>

<script>
    let itemIndex = 1;

    function addItem() {
        const template = document.getElementById('rowTemplate').innerHTML;
        const html = template.replace(/INDEX/g, itemIndex);
        
        const tbody = document.getElementById('itemsBody');
        tbody.insertAdjacentHTML('beforeend', html);
        
        // Re-initialize lucide icons for new elements
        lucide.createIcons();
        itemIndex++;
    }

    function removeItem(button) {
        const tbody = document.getElementById('itemsBody');
        if (tbody.children.length > 1) {
            button.closest('tr').remove();
            calculateGrandTotal();
        } else {
            alert('Minimal harus ada 1 barang dalam PO.');
        }
    }
    
    function updatePrice(selectElement) {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const price = selectedOption.getAttribute('data-harga');
        const tr = selectElement.closest('tr');
        const priceInput = tr.querySelector('input[name*="[harga_satuan]"]');
        
        if (price) {
            priceInput.value = price;
        } else {
            priceInput.value = '';
        }
        
        // Trigger subtotal update
        const qtyInput = tr.querySelector('input[name*="[jumlah]"]');
        calculateSubtotal(qtyInput);
    }

    function calculateSubtotal(qtyInput) {
        const tr = qtyInput.closest('tr');
        const priceInput = tr.querySelector('input[name*="[harga_satuan]"]');
        const subtotalInput = tr.querySelector('.subtotal-input');
        
        const qty = parseFloat(qtyInput.value) || 0;
        const price = parseFloat(priceInput.value) || 0;
        const subtotal = qty * price;
        
        subtotalInput.value = new Intl.NumberFormat('id-ID').format(subtotal);
        calculateGrandTotal();
    }

    function calculateGrandTotal() {
        const subtotals = document.querySelectorAll('.subtotal-input');
        let grandTotal = 0;
        
        subtotals.forEach(input => {
            const val = input.value.replace(/\./g, '');
            grandTotal += parseFloat(val) || 0;
        });
        
        document.getElementById('grandTotal').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(grandTotal);
    }
</script>
@endsection
