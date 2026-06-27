<?php

namespace App\Http\Controllers\Customer;

use App\Models\SuratJalan;
use App\Models\Pengiriman;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CustomerShipmentController extends Controller
{
    public function index()
    {
        $shipments = Pengiriman::whereHas('pesanan', function ($query) {
            $query->where('user_id', Auth::id());
        })->with('pesanan', 'suratJalan', 'distribusi')->paginate(10);

        return view('customer.shipments.index', compact('shipments'));
    }

    public function show(Pengiriman $shipment)
    {
        if ($shipment->pesanan->user_id !== Auth::id()) {
            abort(403);
        }

        $shipment->load(['pesanan', 'suratJalan', 'distribusi']);
        return view('customer.shipments.track', compact('shipment'));
    }

    public function track(Pengiriman $shipment)
    {
        if ($shipment->pesanan->user_id !== Auth::id()) {
            abort(403);
        }

        $shipment->load(['pesanan', 'suratJalan', 'distribusi']);
        return view('customer.shipments.track', compact('shipment'));
    }

    public function confirmReceipt(Pengiriman $shipment)
    {
        if ($shipment->pesanan->user_id !== Auth::id()) {
            abort(403);
        }

        $shipment->load(['pesanan', 'suratJalan']);
        
        // Cek jika sudah diterima sebelumnya
        if ($shipment->status_kirim === 'diterima') {
            return redirect()->route('customer.shipments.track', $shipment)->with('success', 'Barang ini sudah dikonfirmasi diterima sebelumnya.');
        }

        return view('customer.shipments.confirm', compact('shipment'));
    }

    public function confirm(Pengiriman $shipment)
    {
        if ($shipment->pesanan->user_id !== Auth::id()) {
            abort(403);
        }

        // 1. Update status Pengiriman
        $shipment->update([
            'status_kirim' => 'diterima',
        ]);

        // Catat di distribusi (Log Track)
        $shipment->distribusi()->create([
            'lokasi_terkini' => 'Diterima Pelanggan',
            'catatan' => 'Pesanan telah diterima dan dikonfirmasi langsung melalui QR Code oleh pelanggan.',
        ]);

        // 2. Update status Surat Jalan
        if ($shipment->suratJalan) {
            $shipment->suratJalan->update([
                'status' => 'diterima',
                'waktu_penerimaan' => now(),
            ]);
        }

        // 3. Update status Pesanan
        $shipment->pesanan->update([
            'status' => 'selesai',
        ]);

        return redirect()->route('customer.shipments.track', $shipment)->with('success', 'Konfirmasi Penerimaan Berhasil! Terima kasih telah berbelanja di Paramitra.');
    }
}
