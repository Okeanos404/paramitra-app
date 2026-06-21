@extends('layouts.app')

@section('title', 'Riwayat Pembayaran')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <h2 class="text-3xl font-black text-slate-800">Riwayat <span class="text-emerald-600">Pembayaran</span></h2>
        
        <div class="flex items-center gap-4 bg-emerald-50 px-6 py-3 rounded-2xl border border-emerald-100">
            <i data-lucide="clock" class="w-5 h-5 text-emerald-600"></i>
            <div>
                <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest mb-1">Menunggu Konfirmasi</p>
                <p class="font-bold text-slate-800 leading-none">{{ $pendingPayments ?? 0 }} Transaksi</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/10">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">No. Pesanan</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Metode</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Jumlah</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Tanggal</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($payments as $payment)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 font-bold text-slate-800">ORD-{{ str_pad($payment->pesanan_id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">
                            {{ $payment->paymentMethod->nama_metode ?? 'Transfer Bank' }}
                        </td>
                        <td class="px-6 py-4 font-black text-slate-900">Rp{{ number_format($payment->amount, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-sm text-slate-500">{{ $payment->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            @if($payment->status == 'success')
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-600 border border-emerald-100 rounded-full text-[10px] font-bold uppercase tracking-widest">Berhasil</span>
                            @elseif($payment->status == 'pending')
                                <span class="px-3 py-1 bg-amber-50 text-amber-600 border border-amber-100 rounded-full text-[10px] font-bold uppercase tracking-widest">Pending</span>
                            @else
                                <span class="px-3 py-1 bg-red-50 text-red-600 border border-red-100 rounded-full text-[10px] font-bold uppercase tracking-widest">Gagal</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-400">Belum ada riwayat pembayaran.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-6">
            {{ $payments->links() }}
        </div>
    </div>
</div>
@endsection
