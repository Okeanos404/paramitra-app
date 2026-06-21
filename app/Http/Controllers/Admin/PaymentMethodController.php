<?php

namespace App\Http\Controllers\Admin;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $paymentMethods = PaymentMethod::all();
        return view('admin.payment-methods.index', compact('paymentMethods'));
    }

    public function create()
    {
        return view('admin.payment-methods.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_metode' => 'required|unique:payment_methods,nama_metode',
            'deskripsi' => 'nullable',
            'tipe' => 'required|in:cash,bank_transfer,giro,credit_card,e_wallet',
        ]);

        PaymentMethod::create($validated);
        return redirect()->route('payment-methods.index')->with('success', 'Payment method created successfully');
    }

    public function edit(PaymentMethod $paymentMethod)
    {
        return view('admin.payment-methods.edit', compact('paymentMethod'));
    }

    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $validated = $request->validate([
            'nama_metode' => 'required|unique:payment_methods,nama_metode,' . $paymentMethod->id,
            'deskripsi' => 'nullable',
            'tipe' => 'required|in:cash,bank_transfer,giro,credit_card,e_wallet',
            'is_active' => 'boolean',
        ]);

        $paymentMethod->update($validated);
        return redirect()->route('payment-methods.index')->with('success', 'Payment method updated successfully');
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();
        return redirect()->route('payment-methods.index')->with('success', 'Payment method deleted successfully');
    }
}
