<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\LogisticsController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\SuratJalanController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\TransferBarangController;
use App\Http\Controllers\Admin\PurchaseOrderController;
use App\Http\Controllers\Admin\ArchiveController;
use App\Http\Controllers\Customer\CustomerDashboardController;
use App\Http\Controllers\Management\ManagementController;
use Illuminate\Support\Facades\Route;

if (!file_exists(public_path('images/bg-office.png'))) {
    @copy("C:/Users/riyan/.gemini/antigravity/brain/971ef05d-d28d-4c0f-8116-37138ab051f8/media__1779043352973.png", public_path("images/bg-office.png"));
}

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('products', ProductController::class)->except(['index', 'show']);
    Route::resource('orders', OrderController::class);
    Route::resource('customers', \App\Http\Controllers\Admin\CustomerManagementController::class)->except(['index', 'show']);
    Route::post('orders/{pesanan}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::post('orders/{pesanan}/approve-payment', [OrderController::class, 'approvePayment'])->name('orders.approvePayment');

    Route::get('logistics', [LogisticsController::class, 'index'])->name('logistics.index');
    Route::post('logistics', [LogisticsController::class, 'store'])->name('logistics.store');
    Route::post('logistics/{pengiriman}/track', [LogisticsController::class, 'updateTracking'])->name('logistics.updateTracking');

    // Payment & Invoice Routes
    Route::resource('payment-methods', PaymentMethodController::class);
    // invoices index & show are in shared block
    Route::resource('invoices', InvoiceController::class)->except(['index', 'show']);
    Route::post('invoices/{pesanan}/generate', [InvoiceController::class, 'generate'])->name('invoices.generate');
    Route::post('invoices/{invoice}/mark-paid', [InvoiceController::class, 'markAsPaid'])->name('invoices.markAsPaid');
    Route::get('invoices/{invoice}/pdf', [InvoiceController::class, 'pdf'])->name('invoices.pdf');

    // Surat Jalan Routes
    Route::resource('surat-jalan', SuratJalanController::class, ['only' => ['index', 'show']]);
    Route::get('surat-jalan/create/{pengiriman}', [SuratJalanController::class, 'create'])->name('surat-jalan.create');
    Route::post('surat-jalan', [SuratJalanController::class, 'store'])->name('surat-jalan.store');
    Route::post('surat-jalan/{suratJalan}/mark-received', [SuratJalanController::class, 'updateReceived'])->name('surat-jalan.updateReceived');

    // Supplier Routes
    Route::resource('suppliers', SupplierController::class)->except(['index', 'show']);
    Route::get('suppliers/{supplier}/contacts/create', [SupplierController::class, 'createContact'])->name('suppliers.contacts.create');
    Route::post('suppliers/{supplier}/contacts', [SupplierController::class, 'storeContact'])->name('suppliers.contacts.store');

    // Transfer Barang Routes
    Route::resource('transfer-barang', TransferBarangController::class, ['only' => ['index', 'create', 'store', 'show']]);
    Route::post('transfer-barang/{transferBarang}/approve', [TransferBarangController::class, 'approve'])->name('transfer-barang.approve');
    Route::post('transfer-barang/{transferBarang}/mark-received', [TransferBarangController::class, 'markReceived'])->name('transfer-barang.markReceived');

    // Purchase Order Routes
    Route::resource('purchase-orders', PurchaseOrderController::class)->except(['index', 'show']);
    Route::post('purchase-orders/{purchaseOrder}/send', [PurchaseOrderController::class, 'send'])->name('purchase-orders.send');
    Route::post('purchase-orders/{purchaseOrder}/confirm', [PurchaseOrderController::class, 'confirm'])->name('purchase-orders.confirm');

    // Goods Receipt Routes
    Route::get('purchase-orders/{purchaseOrder}/goods-receipt/create', [\App\Http\Controllers\Admin\GoodsReceiptController::class, 'create'])->name('goods-receipt.create');
    Route::post('purchase-orders/{purchaseOrder}/goods-receipt', [\App\Http\Controllers\Admin\GoodsReceiptController::class, 'store'])->name('goods-receipt.store');

    // Archive Route
    Route::get('arsip', [ArchiveController::class, 'index'])->name('arsip.index');
});

// Shared Routes (Admin & Manajemen)
Route::middleware(['auth', 'role:admin,manajemen'])->prefix('admin')->group(function () {
    Route::resource('products', ProductController::class)->only(['index', 'show']);
    Route::resource('customers', \App\Http\Controllers\Admin\CustomerManagementController::class)->only(['index', 'show']);
    Route::resource('suppliers', SupplierController::class)->only(['index', 'show']);
    Route::resource('invoices', InvoiceController::class)->only(['index', 'show']);
    Route::resource('purchase-orders', PurchaseOrderController::class)->only(['index', 'show']);
    
    // Purchase Order Approval (Shared, handled in view/controller for role check)
    Route::post('purchase-orders/{purchaseOrder}/approve', [PurchaseOrderController::class, 'approve'])->name('purchase-orders.approve');
    Route::post('purchase-orders/{purchaseOrder}/reject', [PurchaseOrderController::class, 'reject'])->name('purchase-orders.reject');
});

// Management Routes
Route::middleware(['auth', 'role:manajemen'])->prefix('manajemen')->group(function () {
    Route::get('/dashboard', [ManagementController::class, 'index'])->name('manajemen.dashboard');
    Route::get('/report', [ManagementController::class, 'report'])->name('manajemen.report');
    Route::get('/arsip', [ManagementController::class, 'archive'])->name('manajemen.arsip');
});

// Customer Routes
Route::middleware(['auth', 'role:pelanggan'])->prefix('customer')->group(function () {
    Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
    Route::get('/track/{pesanan}', [CustomerDashboardController::class, 'track'])->name('customer.track');
    
    // Shopping Cart Features
    Route::get('/products', [\App\Http\Controllers\Customer\CartController::class, 'products'])->name('customer.products');
    Route::get('/cart', [\App\Http\Controllers\Customer\CartController::class, 'index'])->name('customer.cart');
    Route::post('/cart/add/{produk}', [\App\Http\Controllers\Customer\CartController::class, 'add'])->name('customer.cart.add');
    Route::post('/cart/remove/{id}', [\App\Http\Controllers\Customer\CartController::class, 'remove'])->name('customer.cart.remove');
    Route::post('/checkout', [\App\Http\Controllers\Customer\CartController::class, 'checkout'])->name('customer.checkout');

    // Customer Invoice Routes
    Route::resource('invoices', \App\Http\Controllers\Customer\CustomerInvoiceController::class)->only(['index', 'show'])->names('customer.invoices');
    Route::get('invoices/{invoice}/pdf', [\App\Http\Controllers\Customer\CustomerInvoiceController::class, 'pdf'])->name('customer.invoices.pdf');

    // Customer Payment Routes
    Route::resource('payments', \App\Http\Controllers\Customer\CustomerPaymentController::class)->only(['index', 'show'])->names('customer.payments');

    // Customer Shipment Routes
    Route::resource('shipments', \App\Http\Controllers\Customer\CustomerShipmentController::class)->only(['index', 'show'])->names('customer.shipments');
    Route::get('shipments/{shipment}/track', [\App\Http\Controllers\Customer\CustomerShipmentController::class, 'track'])->name('customer.shipments.track');
    Route::get('shipments/{shipment}/confirm-receipt', [\App\Http\Controllers\Customer\CustomerShipmentController::class, 'confirmReceipt'])->name('customer.shipments.confirmReceipt');
    Route::post('shipments/{shipment}/confirm', [\App\Http\Controllers\Customer\CustomerShipmentController::class, 'confirm'])->name('customer.shipments.confirm');
});
