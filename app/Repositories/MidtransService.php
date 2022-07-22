<?php

namespace App\Repositories;

use App\Models\TransactionDetail;
use Exception;

class MidtransService extends Repository
{

    public function __construct()
    {
        \Midtrans\Config::$serverKey = env('SERVER_KEY_MIDTRANS');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = env('PRODUCTION_MIDTRANS');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
    }

    public function pay(TransactionDetail $transactionDetail)
    {
        $customer = $transactionDetail->user;
        $date = date('ymdH:i');
        $item_price = $transactionDetail->total;
        $item_details = array();
        $orderId = 'KTA/'.$date.'/'.sprintf('%03d',$transactionDetail->id);
        $items = $transactionDetail->transactions;
        $customer_details = array(
            'first_name' => $customer->name,
            'email'    => $customer->email,
            'phone'    => $customer->anggota->nohp,
        );

        foreach ($items as $idx => $item) {
            $item_details[$idx] = array(
                'id' => $item->anggota->kode,
                'price' => $item->harga,
                'quantity' => 1,
                'name' => 'KTA-',$item->anggota->name,
            );
        }

        $transaction_details = array(
            'order_id' => $orderId,
            'gross_amount' =>$item_price, // no decimal allowed for creditcard
        );

        // Fill SNAP API parameter
        $params = array(
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
        );

        try {
            // Get Snap Payment Page URL
            $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;
            // Redirect to Snap Payment Page

            $transactionDetail->update([
                'code' => $orderId,
                'snap_token' => $paymentUrl
            ]);

            return $paymentUrl;
        }
        catch (Exception $e) {
            return response($e->getMessage());
        }
    }

     public function notification()
    {
        $notif = new \Midtrans\Notification();

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;
        $transaksi = Transaction::where('invoice', $order_id)->first();
        $booking = $transaksi->booking;
        if ($transaction == 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            $transaksi->update([
                'transaction_status_id' => 2,
                'is_paid' => 0,
            ]);
            if ($type == 'credit_card'){
                if($fraud == 'challenge'){
                    // TODO set payment status in merchant's database to 'Challenge by FDS'
                    // TODO merchant should decide whether this transaction is authorized or not in MAP
                    $transaksi->update([
                        'transaction_status_id' => 11,
                        'is_paid' => 0,
                    ]);
                    return response( "Transaction order_id: " . $order_id ." is challenged by FDS");
                }
                else {
                    $transaksi->update([
                        'transaction_status_id' => 3,
                        'is_paid' => 1,
                    ]);
                    $this->booked($booking, $transaksi);
                    // TODO set payment status in merchant's database to 'Success'
                    return response( "Transaction order_id: " . $order_id ." successfully captured using " . $type);
                }
            }
        }
        else if ($transaction == 'settlement'){
            $transaksi->update([
                'transaction_status_id' => 3,
                'is_paid' => 1,
            ]);
            $this->booked($booking, $transaksi);
            // TODO set payment status in merchant's database to 'Settlement'
            return response( "Transaction order_id: " . $order_id ." successfully transfered using " . $type);
        }
        else if($transaction == 'pending'){
            // TODO set payment status in merchant's database to 'Pending'
            $transaksi->update([
                'transaction_status_id' => 4,
                'is_paid' => 0,
            ]);
            return response( "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type);
        }
        else if ($transaction == 'deny') {
            // TODO set payment status in merchant's database to 'Denied'
            $transaksi->update([
                'transaction_status_id' => 5,
                'is_paid' => 0,
            ]);
            return response( "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.");
        }
        else if ($transaction == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            $transaksi->update([
                'transaction_status_id' => 7,
                'is_paid' => 0,
            ]);

            // $this->newSnapUrl($order_id);
            return response( "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.");
        }
        else if ($transaction == 'cancel') {
            // TODO set payment status in merchant's database to 'Denied'
            $transaksi->update([
                'transaction_status_id' => 6,
                'is_paid' => 0,
            ]);

            // $this->newSnapUrl($order_id);
            return response( "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.");
        }
    }
}
