<?php

namespace App\Http\Controllers\Admin;

use App\Models\SuratJalan;
use App\Models\Pengiriman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuratJalanController extends Controller
{
    public function index()
    {
        $suratJalans = SuratJalan::with('pengiriman.pesanan.user')->paginate(15);
        return view('admin.surat-jalan.index', compact('suratJalans'));
    }

    public function create(Pengiriman $pengiriman)
    {
        if ($pengiriman->suratJalan) {
            return redirect()->back()->with('error', 'Surat Jalan already created for this shipment');
        }

        return view('admin.surat-jalan.create', compact('pengiriman'));
    }

    public function store(Request $request, Pengiriman $pengiriman)
    {
        $validated = $request->validate([
            'alamat_pengiriman' => 'required',
            'penerima_nama' => 'required',
            'catatan_khusus' => 'nullable',
        ]);

        $noSuratJalan = $this->generateNoSuratJalan();

        $suratJalan = SuratJalan::create([
            'pengiriman_id' => $pengiriman->id,
            'no_surat_jalan' => $noSuratJalan,
            'tanggal_surat' => now(),
            'alamat_pengiriman' => $validated['alamat_pengiriman'],
            'penerima_nama' => $validated['penerima_nama'],
            'catatan_khusus' => $validated['catatan_khusus'],
            'status' => 'terbit',
        ]);

        return redirect()->route('surat-jalan.show', $suratJalan)->with('success', 'Surat Jalan created successfully');
    }

    public function show(SuratJalan $suratJalan)
    {
        $suratJalan->load(['pengiriman.pesanan.user', 'pengiriman.pesanan.detailPesanan.produk']);
        return view('admin.surat-jalan.show', compact('suratJalan'));
    }

    public function updateReceived(Request $request, SuratJalan $suratJalan)
    {
        $validated = $request->validate([
            'penerima_ttd' => 'nullable',
        ]);

        $suratJalan->update([
            'status' => 'diterima',
            'waktu_penerimaan' => now(),
            'penerima_ttd' => $validated['penerima_ttd'] ?? null,
        ]);

        if ($suratJalan->pengiriman) {
            $suratJalan->pengiriman->update(['status_kirim' => 'diterima']);
            $suratJalan->pengiriman->distribusi()->create([
                'lokasi_terkini' => 'Diterima Pelanggan',
                'catatan' => 'Pesanan diterima (Terkonfirmasi via QR Surat Jalan).',
            ]);
            if ($suratJalan->pengiriman->pesanan) {
                $suratJalan->pengiriman->pesanan->update(['status' => 'selesai']);
            }
        }

        return redirect()->back()->with('success', 'Surat Jalan marked as received and order completed.');
    }

    protected function generateNoSuratJalan()
    {
        $count = SuratJalan::whereDate('created_at', today())->count() + 1;
        return 'SJ-' . date('Ymd') . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    }
}
