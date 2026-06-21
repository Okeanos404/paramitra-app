<?php

namespace App\Http\Controllers\Admin;

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\Supplier;
use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $purchaseOrders = PurchaseOrder::with('supplier', 'admin')->paginate(15);
        return view('admin.purchase-orders.index', compact('purchaseOrders'));
    }

    public function create()
    {
        $suppliers = Supplier::where('status', 'active')->get();
        $products = Produk::orderBy('nama_produk')->get();
        return view('admin.purchase-orders.create', compact('suppliers', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'tanggal_kirim_diharapkan' => 'required|date',
            'items' => 'required|array',
            'items.*.produk_id' => 'required|exists:produk,id',
            'items.*.jumlah' => 'required|integer|min:1',
            'items.*.harga_satuan' => 'required|numeric|min:0',
            'notes' => 'nullable',
        ]);

        $poNumber = $this->generatePONumber();
        $totalAmount = 0;

        $purchaseOrder = PurchaseOrder::create([
            'po_number' => $poNumber,
            'supplier_id' => $validated['supplier_id'],
            'admin_id' => Auth::id(),
            'tanggal_po' => now(),
            'tanggal_kirim_diharapkan' => $validated['tanggal_kirim_diharapkan'],
            'status' => 'pending_approval',
            'notes' => $validated['notes'] ?? null,
        ]);

        foreach ($validated['items'] as $item) {
            $subtotal = $item['jumlah'] * $item['harga_satuan'];
            $totalAmount += $subtotal;

            PurchaseOrderItem::create([
                'purchase_order_id' => $purchaseOrder->id,
                'produk_id' => $item['produk_id'],
                'jumlah' => $item['jumlah'],
                'harga_satuan' => $item['harga_satuan'],
                'subtotal' => $subtotal,
            ]);
        }

        $purchaseOrder->update(['total_amount' => $totalAmount]);

        return redirect()->route('purchase-orders.show', $purchaseOrder)->with('success', 'Purchase Order created successfully');
    }

    public function show(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->load(['supplier', 'items.produk', 'goodsReceipts']);
        return view('admin.purchase-orders.show', compact('purchaseOrder'));
    }

    public function send(PurchaseOrder $purchaseOrder)
    {
        if (!in_array($purchaseOrder->status, ['draft', 'approved'])) {
            return redirect()->back()->with('error', 'Only draft or approved PO can be sent');
        }

        $purchaseOrder->update(['status' => 'sent']);
        return redirect()->back()->with('success', 'Purchase Order sent to supplier');
    }

    public function confirm(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->update(['status' => 'confirmed']);
        return redirect()->back()->with('success', 'Purchase Order confirmed');
    }

    public function approve(PurchaseOrder $purchaseOrder)
    {
        if (Auth::user()->role !== 'manajemen') {
            return redirect()->back()->with('error', 'Unauthorized. Only Manager can approve PO.');
        }
        
        $purchaseOrder->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Purchase Order approved by Manager');
    }

    public function reject(PurchaseOrder $purchaseOrder)
    {
        if (Auth::user()->role !== 'manajemen') {
            return redirect()->back()->with('error', 'Unauthorized. Only Manager can reject PO.');
        }

        $purchaseOrder->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'Purchase Order rejected by Manager');
    }

    protected function generatePONumber()
    {
        $count = PurchaseOrder::whereDate('created_at', today())->count() + 1;
        return 'PO-' . date('Ymd') . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    }
}
