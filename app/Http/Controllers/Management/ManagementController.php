<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\Pengiriman;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    public function index(Request $request)
    {
        $total_revenue = Pesanan::where('status', 'selesai')->sum('total_harga');
        $total_expense = PurchaseOrder::where('status', 'received')->sum('total_amount');
        
        $low_stock_count = Produk::where('stok', '<', 20)->count();
        $active_shipments_count = Pengiriman::whereIn('status_kirim', ['gudang', 'perjalanan'])->count();

        $recent_sales = Pesanan::with('user')->where('status', 'selesai')->latest()->take(10)->get();
        $recent_purchases = PurchaseOrder::with('supplier')->where('status', 'received')->latest()->take(10)->get();

        $range = $request->get('range', 6);
        
        // Chart Data
        $chartData = [
            'labels' => [],
            'pemasukan' => [],
            'pengeluaran' => []
        ];

        if ($range == 1) {
            $titleRange = '1 Bulan Terakhir (Harian)';
            // 30 hari terakhir
            for ($i = 29; $i >= 0; $i--) {
                $date = now()->subDays($i);
                $chartData['labels'][] = $date->format('d M');
                
                $chartData['pemasukan'][] = Pesanan::where('status', 'selesai')
                    ->whereDate('tanggal_pesanan', $date->toDateString())
                    ->sum('total_harga');
                    
                $chartData['pengeluaran'][] = PurchaseOrder::where('status', 'received')
                    ->whereDate('tanggal_po', $date->toDateString())
                    ->sum('total_amount');
            }
        } else {
            $months = $range == 12 ? 12 : 6;
            $titleRange = $months == 12 ? '1 Tahun Terakhir' : '6 Bulan Terakhir';
            
            for ($i = $months - 1; $i >= 0; $i--) {
                $month = now()->subMonths($i);
                $chartData['labels'][] = $month->format('M Y');
                
                $chartData['pemasukan'][] = Pesanan::where('status', 'selesai')
                    ->whereYear('tanggal_pesanan', $month->year)
                    ->whereMonth('tanggal_pesanan', $month->month)
                    ->sum('total_harga');
                    
                $chartData['pengeluaran'][] = PurchaseOrder::where('status', 'received')
                    ->whereYear('tanggal_po', $month->year)
                    ->whereMonth('tanggal_po', $month->month)
                    ->sum('total_amount');
            }
        }

        return view('management.dashboard', compact('total_revenue', 'total_expense', 'low_stock_count', 'active_shipments_count', 'recent_sales', 'recent_purchases', 'chartData', 'titleRange', 'range'));
    }

    public function report(Request $request)
    {
        $salesQuery = Pesanan::with(['user', 'detailPesanan.produk'])->where('status', 'selesai');
        $purchasesQuery = PurchaseOrder::with(['supplier', 'items.produk'])->where('status', 'received');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $salesQuery->whereBetween('tanggal_pesanan', [$request->start_date, $request->end_date]);
            $purchasesQuery->whereBetween('tanggal_po', [$request->start_date, $request->end_date]);
        }

        $sales = $salesQuery->latest()->get();
        $purchases = $purchasesQuery->latest()->get();

        return view('management.report', compact('sales', 'purchases'));
    }

    public function archive(Request $request)
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

        return view('management.archive', compact('archives', 'type'));
    }
}
