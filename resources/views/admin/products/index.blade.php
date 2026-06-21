@extends('layouts.app')

@section('title', 'Manajemen Produk')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-3xl font-black text-slate-800">Manajemen <span class="text-indigo-600">Inventori</span></h2>
        @if(Auth::user()->role === 'admin')
        <button onclick="toggleModal('modal-add')" class="px-6 py-2 bg-indigo-600 text-white rounded-xl font-bold flex items-center gap-2 hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-600/30">
            <i data-lucide="plus" class="w-5 h-5"></i> Tambah Produk
        </button>
        @endif
    </div>

    <!-- Product Table -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="px-6 py-4 text-sm font-semibold text-slate-600">Nama Produk</th>
                        <th class="px-6 py-4 text-sm font-semibold text-slate-600">Kategori</th>
                        <th class="px-6 py-4 text-sm font-semibold text-slate-600">Harga</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                        @if(Auth::user()->role === 'admin')
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest rounded-r-2xl text-center">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($products as $product)
                    <tr class="hover:bg-slate-50 transition-colors group">
                        <td class="px-6 py-4">
                            <p class="font-bold text-slate-800">{{ $product->nama_produk }}</p>
                            <p class="text-xs text-slate-400 truncate max-w-xs">{{ $product->deskripsi }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-xs font-semibold uppercase">{{ $product->kategori }}</span>
                        </td>
                        <td class="px-6 py-4 font-semibold text-slate-700">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <span class="font-bold {{ $product->stok < 20 ? 'text-red-500' : 'text-slate-700' }}">{{ $product->stok }}</span>
                                @if($product->stok < 20)
                                <i data-lucide="alert-triangle" class="w-4 h-4 text-red-500"></i>
                                @endif
                            </div>
                        </td>
                        @if(Auth::user()->role === 'admin')
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="editProduct({{ $product }})" class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-colors" title="Edit Produk">
                                    <i data-lucide="edit-3" class="w-5 h-5"></i>
                                </button>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-colors" title="Hapus Produk">
                                        <i data-lucide="trash-2" class="w-5 h-5"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ Auth::user()->role === 'admin' ? 5 : 4 }}" class="px-6 py-12 text-center text-slate-400">Belum ada data produk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Add -->
<div id="modal-add" class="fixed inset-0 z-[60] hidden overflow-y-auto">
    <div class="min-h-screen px-4 flex items-center justify-center">
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>
        <div class="relative bg-white w-full max-w-lg rounded-3xl shadow-2xl p-8 slide-in">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-xl font-bold text-slate-800">Tambah Produk Baru</h3>
                <button onclick="toggleModal('modal-add')" class="text-slate-400 hover:text-slate-600">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>
            <form action="{{ route('products.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Produk</label>
                    <input type="text" name="nama_produk" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Kategori</label>
                        <select name="kategori" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                            <option value="Pigmen Organik">Pigmen Organik</option>
                            <option value="Pigmen Anorganik">Pigmen Anorganik</option>
                            <option value="Solvent">Solvent</option>
                            <option value="Resin">Resin</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Stok Awal</label>
                        <input type="number" name="stok" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Harga (Rp)</label>
                    <input type="number" name="harga" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 transition-all"></textarea>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-xl shadow-lg hover:bg-blue-700 transition-all">Simpan Produk</button>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div id="modal-edit" class="fixed inset-0 z-[60] hidden overflow-y-auto">
    <div class="min-h-screen px-4 flex items-center justify-center">
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>
        <div class="relative bg-white w-full max-w-lg rounded-3xl shadow-2xl p-8 slide-in">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-xl font-bold text-slate-800">Edit Produk</h3>
                <button onclick="toggleModal('modal-edit')" class="text-slate-400 hover:text-slate-600">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>
            <form id="form-edit" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Produk</label>
                    <input type="text" name="nama_produk" id="edit-nama" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Kategori</label>
                        <select name="kategori" id="edit-kategori" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                            <option value="Pigmen Organik">Pigmen Organik</option>
                            <option value="Pigmen Anorganik">Pigmen Anorganik</option>
                            <option value="Solvent">Solvent</option>
                            <option value="Resin">Resin</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Stok</label>
                        <input type="number" name="stok" id="edit-stok" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Harga (Rp)</label>
                    <input type="number" name="harga" id="edit-harga" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi</label>
                    <textarea name="deskripsi" id="edit-deskripsi" rows="3" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 transition-all"></textarea>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-xl shadow-lg hover:bg-blue-700 transition-all">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleModal(id) {
        const modal = document.getElementById(id);
        modal.classList.toggle('hidden');
    }

    function editProduct(product) {
        document.getElementById('form-edit').action = `/admin/products/${product.id}`;
        document.getElementById('edit-nama').value = product.nama_produk;
        document.getElementById('edit-kategori').value = product.kategori;
        document.getElementById('edit-stok').value = product.stok;
        document.getElementById('edit-harga').value = product.harga;
        document.getElementById('edit-deskripsi').value = product.deskripsi || '';
        toggleModal('modal-edit');
    }
</script>
@endsection
