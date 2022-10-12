@extends('layouts.social')
@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-8">
        <div class="card">
            <div class="border-bottom title-part-padding d-flex justify-content-between card-header">
                <h4 class="card-title mb-0">Form Transaksi Pengiriman</h4>
            </div>
            <form action="{{ route('transaction.store') }}" method="post" class="card-body needs-validation" novalidate>
                @csrf
                {{-- Error Validation --}}
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="alert alert-info">
                    <ul id="error-item">
                        <li>Harap masukan data pengiriman dengan benar</li>
                        <li>KTA akan dikirim sesuai alamat pengiriman</li>
                    </ul>
                </div>
                @include('admin.transaction.form',['total'=>$total])
                <div class="mb-3 btn-group my-3" id="confirm">
                    {{-- <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Kembali</a> --}}
                    <button type="submit" name="social" value="1" class="btn btn-outline-primary">Buat Transaksi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        var table = $(".file-export").DataTable();
    </script>
@endsection
