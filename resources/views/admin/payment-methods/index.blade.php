@extends('layouts.app')

@section('title', 'Metode Bayar')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <h2 class="text-3xl font-black text-slate-800">Metode <span class="text-indigo-600">Bayar</span></h2>
        <a href="{{ route('payment-methods.create') }}" class="px-6 py-2 bg-indigo-600 text-white rounded-xl font-bold flex items-center gap-2 hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-600/30">
            <i data-lucide="plus" class="w-5 h-5"></i> Tambah Metode
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/10">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest rounded-l-2xl">Nama Metode</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Tipe</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest rounded-r-2xl text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($paymentMethods as $method)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <p class="font-bold text-slate-800">{{ $method->nama_metode }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-slate-100 text-slate-600 border border-slate-200 rounded-full text-[10px] font-bold uppercase tracking-widest">
                                {{ str_replace('_', ' ', $method->tipe) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($method->is_active)
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-600 border border-emerald-100 rounded-full text-[10px] font-bold uppercase tracking-widest">Aktif</span>
                            @else
                                <span class="px-3 py-1 bg-red-50 text-red-600 border border-red-100 rounded-full text-[10px] font-bold uppercase tracking-widest">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('payment-methods.edit', $method->id) }}" class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-colors" title="Edit Metode">
                                    <i data-lucide="edit" class="w-5 h-5"></i>
                                </a>
                                <form method="POST" action="{{ route('payment-methods.destroy', $method->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus metode pembayaran ini?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-colors" title="Hapus Metode">
                                        <i data-lucide="trash-2" class="w-5 h-5"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-slate-400">Belum ada data metode pembayaran.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
