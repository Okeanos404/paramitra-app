<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type', 'pemasukan');

        if ($type === 'pengeluaran') {
            $query = PurchaseOrder::with(['supplier', 'admin'])
                ->where('status', 'received');

            if ($request->filled('start_date') && $request->filled('end_date')) {
                $query->whereBetween('tanggal_po', [$request->start_date, $request->end_date]);
            }
        } else {
            $query = Pesanan::with(['user', 'pengiriman.suratJalan'])
                ->where('status', 'selesai');

            if ($request->filled('start_date') && $request->filled('end_date')) {
                $query->whereBetween('tanggal_pesanan', [$request->start_date, $request->end_date]);
            }
        }

        $archives = $query->latest()->paginate(20);

        return view('admin.archive.index', compact('archives', 'type'));
    }
}
