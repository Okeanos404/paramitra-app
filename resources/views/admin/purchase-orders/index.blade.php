@extends('layouts.app')

@section('title', 'Purchase Orders (PO Supplier)')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <h2 class="text-3xl font-black text-slate-800">Purchase <span class="text-indigo-600">Orders</span></h2>
        @if(Auth::user()->role === 'admin')
        <a href="{{ route('purchase-orders.create') }}" class="px-6 py-2 bg-indigo-600 text-white rounded-xl font-bold flex items-center gap-2 hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-600/30">
            <i data-lucide="file-plus" class="w-5 h-5"></i> Buat PO Baru
        </a>
        @endif
    </div>

    <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/10">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest rounded-l-2xl">Nomor PO</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Supplier</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Estimasi Tiba</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Nilai</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest rounded-r-2xl text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($purchaseOrders as $po)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 font-bold text-slate-800">
                            {{ $po->po_number }}
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-bold text-indigo-600">{{ optional($po->supplier)->nama_supplier ?? '-' }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-500">
                            {{ \Carbon\Carbon::parse($po->tanggal_kirim_diharapkan)->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 font-black text-slate-900">
                            Rp{{ number_format($po->total_amount, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($po->status === 'pending_approval')
                                <span class="px-3 py-1 bg-fuchsia-50 text-fuchsia-600 border border-fuchsia-100 rounded-full text-[10px] font-bold uppercase tracking-widest flex items-center gap-1 w-max mx-auto"><i data-lucide="clock" class="w-3 h-3"></i> Menunggu Approval</span>
                            @elseif($po->status === 'approved')
                                <span class="px-3 py-1 bg-violet-50 text-violet-600 border border-violet-100 rounded-full text-[10px] font-bold uppercase tracking-widest flex items-center gap-1 w-max mx-auto"><i data-lucide="check-circle" class="w-3 h-3"></i> Disetujui Manager</span>
                            @elseif($po->status === 'draft')
                                <span class="px-3 py-1 bg-slate-100 text-slate-600 border border-slate-200 rounded-full text-[10px] font-bold uppercase tracking-widest">Draft</span>
                            @elseif($po->status === 'rejected')
                                <span class="px-3 py-1 bg-red-50 text-red-600 border border-red-100 rounded-full text-[10px] font-bold uppercase tracking-widest flex items-center gap-1 w-max mx-auto"><i data-lucide="x-circle" class="w-3 h-3"></i> Ditolak</span>
                            @elseif($po->status === 'sent')
                                <span class="px-3 py-1 bg-blue-50 text-blue-600 border border-blue-100 rounded-full text-[10px] font-bold uppercase tracking-widest">Terkirim</span>
                            @elseif($po->status === 'confirmed')
                                <span class="px-3 py-1 bg-indigo-50 text-indigo-600 border border-indigo-100 rounded-full text-[10px] font-bold uppercase tracking-widest">Disetujui Supplier</span>
                            @elseif($po->status === 'partial_received')
                                <span class="px-3 py-1 bg-orange-50 text-orange-600 border border-orange-100 rounded-full text-[10px] font-bold uppercase tracking-widest">Diterima Sebagian</span>
                            @elseif($po->status === 'received')
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-600 border border-emerald-100 rounded-full text-[10px] font-bold uppercase tracking-widest">Diterima Lengkap</span>
                            @else
                                <span class="px-3 py-1 bg-slate-100 text-slate-600 border border-slate-200 rounded-full text-[10px] font-bold uppercase tracking-widest">{{ $po->status }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('purchase-orders.show', $po->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-50 text-slate-600 rounded-lg hover:bg-slate-100 transition-colors text-sm font-bold">
                                <i data-lucide="eye" class="w-4 h-4"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-400">Belum ada riwayat Purchase Order.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-6">
            {{ $purchaseOrders->links() }}
        </div>
    </div>
</div>
@endsection
