<?php

namespace App\Repositories;

use App\Models\TransactionDetail;
use Exception;

class MidtransService extends Repository
{

    // public function __construct()
    // {
    //     \Midtrans\Config::$serverKey = env('SERVER_KEY_MIDTRANS');
    //     // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
    //     \Midtrans\Config::$isProduction = env('PRODUCTION_MIDTRANS');
    //     // Set sanitization on (default)
    //     \Midtrans\Config::$isSanitized = true;
    //     // Set 3DS transaction for credit card to true
    //     \Midtrans\Config::$is3ds = true;
    // }

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
}
