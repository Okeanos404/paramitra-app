@extends('layouts.app')

@section('title', 'Manajemen Supplier')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <h2 class="text-3xl font-black text-slate-800">Manajemen <span class="text-indigo-600">Supplier</span></h2>
        @if(Auth::user()->role === 'admin')
        <a href="/admin/suppliers/create" class="px-6 py-2 bg-indigo-600 text-white rounded-xl font-bold flex items-center gap-2 hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-600/30">
            <i data-lucide="building" class="w-5 h-5"></i> Tambah Supplier
        </a>
        @endif
    </div>

    <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/10">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest rounded-l-2xl">Nama Supplier</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Asal Negara</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Email</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Kontak PIC</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                        @if(Auth::user()->role === 'admin')
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest rounded-r-2xl text-center">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($suppliers as $supplier)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <a href="/admin/suppliers/{{ $supplier->id }}" class="font-bold text-indigo-600 hover:text-indigo-800 transition-colors">
                                {{ $supplier->nama_supplier }}
                            </a>
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-slate-600">
                            {{ $supplier->negara }}
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-500">
                            {{ $supplier->email }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-slate-100 text-slate-600 font-bold text-xs">
                                {{ $supplier->contacts->count() }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($supplier->status === 'active')
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-600 border border-emerald-100 rounded-full text-[10px] font-bold uppercase tracking-widest">Aktif</span>
                            @else
                                <span class="px-3 py-1 bg-red-50 text-red-600 border border-red-100 rounded-full text-[10px] font-bold uppercase tracking-widest">Nonaktif</span>
                            @endif
                        </td>
                        @if(Auth::user()->role === 'admin')
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="/admin/suppliers/{{ $supplier->id }}/edit" class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-colors" title="Edit Supplier">
                                    <i data-lucide="edit" class="w-5 h-5"></i>
                                </a>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ Auth::user()->role === 'admin' ? 6 : 5 }}" class="px-6 py-12 text-center text-slate-400">Belum ada data supplier terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-6">
            {{ $suppliers->links() }}
        </div>
    </div>
</div>
@endsection
