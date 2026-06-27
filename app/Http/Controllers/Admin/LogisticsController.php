<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Pengiriman;
use App\Models\Distribusi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LogisticsController extends Controller
{
    public function index()
    {
        $shipments = Pengiriman::with(['pesanan.user', 'distribusi'])->where('status_kirim', '!=', 'diterima')->latest()->get();
        $pending_orders = Pesanan::where('status', 'proses')->whereDoesntHave('pengiriman')->get();
        
        return view('admin.logistics.index', compact('shipments', 'pending_orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pesanan_id' => 'required|exists:pesanan,id|unique:pengiriman,pesanan_id',
            'kurir' => 'required|string',
        ]);

        $pengiriman = Pengiriman::create([
            'pesanan_id' => $request->pesanan_id,
            'no_resi' => 'PM-' . strtoupper(Str::random(10)),
            'kurir' => $request->kurir,
            'status_kirim' => 'gudang',
        ]);

        // Update pesanan status to 'kirim'
        $pengiriman->pesanan->update(['status' => 'kirim']);

        // Add initial distribution entry
        $pengiriman->distribusi()->create([
            'lokasi_terkini' => 'Gudang PT Paramitra',
            'catatan' => 'Pesanan sedang diproses di gudang.',
        ]);

        // Auto-generate Surat Jalan
        \App\Models\SuratJalan::create([
            'pengiriman_id' => $pengiriman->id,
            'no_surat_jalan' => 'SJ-' . date('Ymd') . '-' . str_pad(\App\Models\SuratJalan::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT),
            'tanggal_surat' => now(),
            'alamat_pengiriman' => $pengiriman->pesanan->user->profile->alamat ?? 'Alamat Pelanggan',
            'penerima_nama' => $pengiriman->pesanan->user->name,
            'catatan_khusus' => 'Barang dikirim dari gudang PT Paramitra menggunakan ' . $request->kurir . '.',
            'status' => 'terbit',
        ]);

        return redirect()->back()->with('success', 'Pengiriman berhasil diproses.');
    }

    public function updateTracking(Request $request, Pengiriman $pengiriman)
    {
        $request->validate([
            'lokasi_terkini' => 'required|string',
            'catatan' => 'nullable|string',
            'status_kirim' => 'required|in:gudang,perjalanan,diterima',
            'kurir' => 'required|string',
        ]);

        $pengiriman->update([
            'status_kirim' => $request->status_kirim,
            'kurir' => $request->kurir
        ]);

        $pengiriman->distribusi()->create([
            'lokasi_terkini' => $request->lokasi_terkini,
            'catatan' => $request->catatan,
        ]);

        if ($request->status_kirim === 'diterima') {
            $pengiriman->pesanan->update(['status' => 'selesai']);
            if ($pengiriman->suratJalan && $pengiriman->suratJalan->status !== 'diterima') {
                $pengiriman->suratJalan->update([
                    'status' => 'diterima',
                    'waktu_penerimaan' => now()
                ]);
            }
        }

        return redirect()->back()->with('success', 'Lokasi pengiriman diperbarui.');
    }
}
