<?php

namespace App\Services;

use App\Models\PaymentTransaction;
use App\Models\Pesanan;

class PaymentService
{
    public function createPaymentTransaction(Pesanan $pesanan, $paymentMethodId, $amount): PaymentTransaction
    {
        $transactionId = $this->generateTransactionId();

        return PaymentTransaction::create([
            'pesanan_id' => $pesanan->id,
            'payment_method_id' => $paymentMethodId,
            'transaction_id' => $transactionId,
            'amount' => $amount,
            'status' => 'pending',
            'gateway_reference' => null,
        ]);
    }

    public function generateTransactionId(): string
    {
        return 'TRX-' . date('YmdHis') . '-' . rand(1000, 9999);
    }

    public function updatePaymentStatus(PaymentTransaction $transaction, $status, $reference = null): bool
    {
        $data = [
            'status' => $status,
            'gateway_reference' => $reference,
        ];

        if ($status === 'success') {
            $data['paid_at'] = now();
            $transaction->pesanan->update(['payment_status' => 'paid']);
        }

        return $transaction->update($data);
    }
}
