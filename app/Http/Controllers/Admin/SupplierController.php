<?php

namespace App\Http\Controllers\Admin;

use App\Models\Supplier;
use App\Models\SupplierContact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::with('contacts', 'products')->paginate(15);
        return view('admin.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('admin.suppliers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_supplier' => 'required|unique:suppliers,nama_supplier',
            'negara' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'email' => 'required|email|unique:suppliers,email',
            'npwp' => 'nullable',
            'nama_bank' => 'nullable',
            'nomor_rekening' => 'nullable',
            'kategori_supplier' => 'required',
        ]);

        Supplier::create($validated);
        return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully');
    }

    public function show(Supplier $supplier)
    {
        $supplier->load(['contacts', 'products.produk']);
        return view('admin.suppliers.show', compact('supplier'));
    }

    public function edit(Supplier $supplier)
    {
        return view('admin.suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'nama_supplier' => 'required|unique:suppliers,nama_supplier,' . $supplier->id,
            'negara' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'email' => 'required|email|unique:suppliers,email,' . $supplier->id,
            'npwp' => 'nullable',
            'nama_bank' => 'nullable',
            'nomor_rekening' => 'nullable',
            'kategori_supplier' => 'required',
            'status' => 'required|in:active,inactive',
        ]);

        $supplier->update($validated);
        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully');
    }

    public function createContact(Supplier $supplier)
    {
        return view('admin.suppliers.create-contact', compact('supplier'));
    }

    public function storeContact(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'nama_kontak' => 'required',
            'posisi' => 'required',
            'telepon' => 'required',
            'email' => 'required|email',
        ]);

        $supplier->contacts()->create($validated);
        return redirect()->route('suppliers.show', $supplier)->with('success', 'Contact added successfully');
    }
}
