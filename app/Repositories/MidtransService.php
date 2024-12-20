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
        $item_price = $transactionDetail->total;
        $item_details = array();
        $date = date('ymdHi');
        $orderId = 'KTA/' . $date . '/' . sprintf('%03d', $transactionDetail->id);
        $items = $transactionDetail->transactions;
        $customer_details = array(
            'first_name' => $customer->name,
            'email'    => $customer->email,
            'phone'    => $customer->anggota->nohp,
        );

        // foreach ($items as $idx => $item) {
        //     $item_details[$idx] = array(
        //         'id' => $item->anggota->kode,
        //         'price' => $item->harga,
        //         'quantity' => 1,
        //         'name' => 'KTA-'.$item->anggota->nama,
        //     );
        // }

        $item_details[0] = array(
            'id' => 'KTA-' . $customer->id,
            'price' => $item_price,
            'quantity' => $items->count(),
            'name' => 'KTA (KARTU TANDA ANGGOTA)',
        );

        $transaction_details = array(
            'order_id' => $orderId,
            'gross_amount' => $item_price, // no decimal allowed for creditcard
        );

        // Fill SNAP API parameter
        $params = array(
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
        );

        try {
            // Get Snap Payment Page URL
            $paymentUrl = \Midtrans\Snap::getSnapToken($params);
            // Redirect to Snap Payment Page

            $transactionDetail->update([
                'code' => $orderId,
                'snap_token' => $paymentUrl
            ]);

            $trx = TransactionDetail::find($transactionDetail->id);

            return $trx;
        } catch (Exception $e) {
            dd($e);
            return response($e->getMessage());
        }
    }

    public function test()
    {
        $date = date('ymdHi');
        $item_details = array();
        $orderId = 'KTA/' . $date . '/' . sprintf('%03d', rand(100, 999));

        $customer_details = array(
            'first_name' => 'test_midtrans',
            'email'    => 'testmidtrans@gmail.com',
            'phone'    => '123456789',
        );

        for ($i = 0; $i < 3; $i++) {
            $item_details[$i] = array(
                'id' => 'BR-00' . $i,
                'price' => 10000,
                'quantity' => 1,
                'name' => 'KTA-' . $i,
            );
        }

        $transaction_details = array(
            'order_id' => $orderId,
            'gross_amount' => 3000, // no decimal allowed for creditcard
        );

        // Fill SNAP API parameter
        $params = array(
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
        );

        try {
            // Get Snap Payment Page URL
            $paymentUrl = \Midtrans\Snap::getSnapToken($params);
            // Redirect to Snap Payment Page

            return $paymentUrl;
        } catch (Exception $e) {
            return response($e->getMessage());
        }
    }

    public function qris(TransactionDetail $transactionDetail)
    {
        $date = date('ymdHis');
        $orderId = 'KTA/' . $date . '/' . sprintf('%03d', $transactionDetail->id);
        $transaction_details = array(
            'order_id'    => $orderId,
            'gross_amount'  => $transactionDetail->item_price
        );

        $items = array(
            array(
                'id'       => "KTA-01",
                'price'    => $transactionDetail->item_price,
                'quantity' => 1,
                'name'     => "KARTU TANDA ANGGOTA (KTA)"
            )
        );

        $customer_details = array(
            'first_name'       => $transactionDetail->user->name,
            'last_name'        => "SIAPSAPA",
            'email'            => $transactionDetail->user->email,
            'phone'            => $transactionDetail->phone,
        );

        // Transaction data to be sent
        $transaction_data = array(
            'payment_type'        => 'qris',
            'transaction_details' => $transaction_details,
            'item_details'        => $items,
            'customer_details'    => $customer_details,
        );

        $response = \Midtrans\CoreApi::charge($transaction_data);
        $transactionDetail->update([
            'code' => $orderId
        ]);
        if ($response) {
            return [
                'payment_url' => $response->actions[0]->url,
                'transaction' => TransactionDetail::find($transactionDetail->id)
            ];
        }
        return false;
    }

    public function checkStatus(TransactionDetail $transactionDetail)
    {
        $status = \Midtrans\Transaction::status($transactionDetail->code);
        if ($status->transaction_status == 'settlement') {
            $transactionDetail->update(['is_paid' => 1, 'status_wizard' => 'photo']);
        }
        return $status;
    }

    public function notification()
    {
        $notif = new \Midtrans\Notification();

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;
        $transaksi = TransactionDetail::where('code', $order_id)->first();
        if ($transaction == 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            $transaksi->update([
                'payment_status' => 2,
            ]);
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    // TODO set payment status in merchant's database to 'Challenge by FDS'
                    // TODO merchant should decide whether this transaction is authorized or not in MAP
                    $transaksi->update([
                        'payment_status' => 11,
                    ]);
                    return response("Transaction order_id: " . $order_id . " is challenged by FDS");
                } else {
                    $transaksi->update([
                        'payment_status' => 3,
                        'status' => 2,
                    ]);
                    foreach ($transaksi->transactions as $item) {
                        $item->anggota->update([
                            'is_cetak' => 1
                        ]);
                    }
                    // $this->booked($booking, $transaksi);
                    // TODO set payment status in merchant's database to 'Success'
                    return response("Transaction order_id: " . $order_id . " successfully captured using " . $type);
                }
            }
        } else if ($transaction == 'settlement') {
            $transaksi->update([
                'payment_status' => 3,
                'status' => 2,
            ]);
            foreach ($transaksi->transactions as $item) {
                $item->anggota->update([
                    'is_cetak' => 1
                ]);
            }
            // $this->booked($booking, $transaksi);
            // TODO set payment status in merchant's database to 'Settlement'
            return response("Transaction order_id: " . $order_id . " successfully transfered using " . $type);
        } else if ($transaction == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            $transaksi->update([
                'payment_status' => 4,
            ]);
            return response("Waiting customer to finish transaction order_id: " . $order_id . " using " . $type);
        } else if ($transaction == 'deny') {
            // TODO set payment status in merchant's database to 'Denied'
            $transaksi->update([
                'payment_status' => 5,
            ]);
            return response("Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.");
        } else if ($transaction == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            $transaksi->update([
                'payment_status' => 7,
            ]);

            // $this->newSnapUrl($order_id);
            return response("Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.");
        } else if ($transaction == 'cancel') {
            // TODO set payment status in merchant's database to 'Denied'
            $transaksi->update([
                'payment_status' => 6,
            ]);

            // $this->newSnapUrl($order_id);
            return response("Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.");
        }
    }
}
