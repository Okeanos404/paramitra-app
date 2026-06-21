@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <div class="flex items-center gap-4">
        <a href="{{ route('customer.products') }}" class="p-3 bg-white rounded-2xl border border-slate-100 hover:border-blue-200 text-slate-600 transition-all">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <h2 class="text-3xl font-bold text-slate-800">Keranjang Belanja</h2>
    </div>

    @if(empty($cart))
    <div class="bg-white rounded-[2.5rem] p-16 text-center border border-slate-100">
        <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
            <i data-lucide="shopping-cart" class="w-12 h-12 text-slate-200"></i>
        </div>
        <h3 class="text-xl font-bold text-slate-800 mb-2">Keranjang Anda Kosong</h3>
        <p class="text-slate-500 mb-8">Anda belum menambahkan produk apapun ke dalam keranjang.</p>
        <a href="{{ route('customer.products') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-blue-600 text-white rounded-2xl font-bold hover:bg-blue-700 transition-all shadow-lg shadow-blue-100">
            Mulai Belanja
        </a>
    </div>
    @else
    <div class="flex flex-col gap-8">
        <!-- Item List -->
        <div class="space-y-4">
            @php $total = 0; @endphp
            @foreach($cart as $id => $details)
            @php $total += $details['price'] * $details['quantity']; @endphp
            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-6 group">
                <div class="w-20 h-20 bg-slate-50 rounded-2xl flex items-center justify-center shrink-0">
                    <i data-lucide="package" class="w-8 h-8 text-slate-300"></i>
                </div>
                <div class="flex-grow">
                    <h4 class="font-bold text-slate-800 text-lg">{{ $details['name'] }}</h4>
                    <p class="text-slate-400 text-xs">{{ $details['category'] }}</p>
                    <div class="flex items-center gap-4 mt-2">
                        <p class="text-blue-600 font-bold">Rp{{ number_format($details['price'], 0, ',', '.') }}</p>
                        <span class="text-slate-300">|</span>
                        <p class="text-slate-500 text-sm">Qty: {{ $details['quantity'] }}</p>
                    </div>
                </div>
                <form action="{{ route('customer.cart.remove', $id) }}" method="POST">
                    @csrf
                    <button type="submit" class="p-3 text-slate-300 hover:text-red-500 hover:bg-red-50 rounded-xl transition-all">
                        <i data-lucide="trash-2" class="w-5 h-5"></i>
                    </button>
                </form>
            </div>
            @endforeach
        </div>

        <!-- Summary -->
        <div class="w-full">
            <div class="bg-slate-900 text-white p-8 rounded-[2.5rem] shadow-xl">
                <h3 class="text-xl font-bold mb-8">Ringkasan Pesanan</h3>
                
                <div class="space-y-4 mb-8">
                    <div class="flex justify-between text-slate-400 text-sm">
                        <span>Subtotal</span>
                        <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-slate-400 text-sm">
                        <span>Biaya Pengiriman</span>
                        <span class="text-emerald-400 font-bold uppercase text-[10px] tracking-widest mt-1">Gratis</span>
                    </div>
                    <div class="pt-4 border-t border-white/10 flex justify-between">
                        <span class="font-bold">Total</span>
                        <span class="text-2xl font-bold text-blue-400">Rp{{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>

                <form action="{{ route('customer.checkout') }}" method="POST">
                    @csrf
                    <!-- Pilihan Pembayaran -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 mb-6">
                        <h3 class="font-bold text-slate-800 mb-4">Pilih Metode Pembayaran</h3>
                        <select name="payment_method_id" id="payment-method-select" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 transition-all font-semibold text-slate-700">
                            <option value="" data-desc="">-- Pilih Pembayaran --</option>
                            @foreach($paymentMethods as $pm)
                                <option value="{{ $pm->id }}" data-desc="{{ $pm->deskripsi }}" data-type="{{ $pm->tipe }}">
                                    {{ $pm->nama_metode }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Virtual Account Info Box (Hidden by default) -->
                        <div id="va-info-box" class="hidden mt-6 bg-blue-50 border border-blue-100 rounded-xl p-5 slide-in">
                            <div class="flex items-start gap-4">
                                <div class="p-3 bg-white rounded-xl shadow-sm">
                                    <i data-lucide="smartphone-nfc" class="w-6 h-6 text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-1" id="va-label">No. Rekening / VA</p>
                                    <p class="text-xl font-black text-slate-800 font-mono tracking-widest" id="va-number">0000-0000-0000</p>
                                    <p class="text-xs text-slate-500 mt-2">Silakan transfer sesuai nominal total pesanan ke nomor di atas setelah Anda menekan tombol Checkout.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" id="btn-checkout" disabled class="w-full bg-slate-300 text-slate-500 cursor-not-allowed font-bold py-4 px-6 rounded-xl transition-all flex items-center justify-center gap-2">
                        <i data-lucide="lock" id="checkout-icon" class="w-5 h-5"></i>
                        <span id="checkout-text">Pilih Pembayaran Dahulu</span>
                    </button>
                </form>

                <p class="text-[10px] text-slate-500 text-center mt-6 uppercase tracking-widest font-bold">Aman & Terenkripsi</p>
            </div>
        </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const select = document.getElementById('payment-method-select');
        const vaBox = document.getElementById('va-info-box');
        const vaNumber = document.getElementById('va-number');
        const vaLabel = document.getElementById('va-label');
        const btnCheckout = document.getElementById('btn-checkout');
        const checkoutIcon = document.getElementById('checkout-icon');
        const checkoutText = document.getElementById('checkout-text');

        select.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const desc = selectedOption.getAttribute('data-desc');
            const type = selectedOption.getAttribute('data-type');

            if (this.value) {
                // Show VA Box
                vaBox.classList.remove('hidden');
                vaNumber.textContent = desc || 'Nomor tidak tersedia';
                vaLabel.textContent = type === 'E-Wallet' ? 'No. Tujuan E-Wallet' : 'Nomor Virtual Account';

                // Enable Checkout Button
                btnCheckout.disabled = false;
                btnCheckout.classList.remove('bg-slate-300', 'text-slate-500', 'cursor-not-allowed');
                btnCheckout.classList.add('bg-blue-600', 'text-white', 'hover:bg-blue-700', 'shadow-xl', 'shadow-blue-200');
                
                checkoutIcon.setAttribute('data-lucide', 'credit-card');
                checkoutText.textContent = 'Checkout Sekarang';
                lucide.createIcons();
            } else {
                // Hide VA Box
                vaBox.classList.add('hidden');

                // Disable Checkout Button
                btnCheckout.disabled = true;
                btnCheckout.classList.add('bg-slate-300', 'text-slate-500', 'cursor-not-allowed');
                btnCheckout.classList.remove('bg-blue-600', 'text-white', 'hover:bg-blue-700', 'shadow-xl', 'shadow-blue-200');
                
                checkoutIcon.setAttribute('data-lucide', 'lock');
                checkoutText.textContent = 'Pilih Pembayaran Dahulu';
                lucide.createIcons();
            }
        });
    });
</script>
@endsection
