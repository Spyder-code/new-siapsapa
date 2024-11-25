@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-warning">
                            {{ strtoupper($transaction->paymentInfo->name ?? '-') }} <br>
                            <i style="font-size: .8rem" class="text-justify">{{ $transaction->paymentInfo->description }}</i>
                        </div>
                        <ul class="list-group mt-2" style="font-size: .8rem">
                            <li class="list-group-item d-flex justify-content-between">
                                INVOICE : <span>{{ $transaction->code }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                ORDER : <span>Cetak {{ $transaction->transactions->count() }} KARTU TANDA ANGGOTA (KTA)</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                TOTAL HARGA: <span>Rp. {{ number_format($transaction->item_price) }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer d-flex justify-between flex-wrap" style="gap: 10px">
                        @if ($transaction->status==1)
                        <form action="{{ route('transaction.pay',$transaction) }}" method="post" style="width: 100%">
                            @csrf
                            <button class="btn py-2 btn-sm btn-warning btn-rounded w-100" type="submit"> Reset Payment Method</button>
                        </form>
                        <div style="width: 100%">
                            <button id="pay-button" class="btn py-2 btn-sm btn-success btn-rounded w-100"> Pay</button>
                        </div>
                        @endif
                        <div style="width: 100%">
                            <button type="button" onclick="checkPayment()" class="btn py-2 btn-sm btn-info btn-rounded w-100"> Check Payment Status</button>
                        </div>
                        <div style="width: 100%">
                            <a href="{{ route('transaction.index') }}" class="btn py-2 btn-sm btn-secondary btn-rounded w-100"> Back to home</a>
                        </div>
                    </div>
                    <pre class="p-4"><div id="result-json">JSON result will appear here after payment:<br></div></pre>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ env('CLIENT_KEY_MIDTRANS') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function(){
            payMidtrans();
        };

        function payMidtrans(){
            snap.pay(@json($transaction->snap_token), {
                // Optional
                onSuccess: function(result){
                    /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result,null, 2);
                },
                // Optional
                onPending: function(result){
                    /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result,null, 2);
                },
                // Optional
                onError: function(result){
                    /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result,null, 2);
                }
            });
        }

        function checkPayment() {
            location.reload()
        }

        payMidtrans();
    </script>
@endpush
