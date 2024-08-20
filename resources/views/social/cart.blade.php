@extends('layouts.social')
@section('content')
<div class="block-box user-top-header">
    <ul class="menu-list">
        <li class="active"><a href="#">Keranjang</a></li>
        <li style="width: 100%"><a href="{{ route('social.transaction') }}">Semua Transaksi</a></li>
        <li style="width: 100%"><a href="{{ route('social.transaction',['status'=>0]) }}">Belum dibayar</a></li>
        <li style="width: 100%"><a href="{{ route('social.transaction',['status'=>1]) }}">Sudah dibayar</a></li>
        {{-- <li>
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    ...
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="user-photo.html#">Shop</a>
                    <a class="dropdown-item" href="user-photo.html#">Blog</a>
                    <a class="dropdown-item" href="user-photo.html#">Others</a>
                </div>
            </div>
        </li> --}}
    </ul>
</div>
<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="border-bottom title-part-padding d-flex justify-content-between card-header">
                    <h4 class="card-title mb-0">List Item</h4>
                    <div class="d-flex" style="gap: 10px">
                        @if ($carts->count() > 0 && Auth::user()->role!='anggota')
                        <p>Jumlah KTA ({{ $carts->count() }})</p>
                        <p>Total: <b>Rp. {{ number_format($carts->sum('harga')) }}</b></p>
                        <a href="{{ route('social.transaction.create') }}" class="btn btn-success pos-relative right-0"><i class="fas fa-print"></i> Buat Transaksi</a>
                        @elseif($carts->count()>0)
                        <div class="alert alert-info">
                            Kartu Tanda Anggota Sedang Dicetak
                        </div>
                        @endif
                    </div>
                </div>
                <div class="table-responsive p-4 card-body">
                    <table class="table table-bordered table-striped file-export" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Golongan</th>
                                <th>Harga</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="justify-content-center text-center">
                                        <img src="{{ asset('berkas/anggota/'.$item->anggota->foto) }}" class="img-thumbnail mx-auto d-block" height="80px" width="80px">
                                        <span class="badge bg-primary">-</span>
                                    </div>
                                </td>
                                <td>{{ $item->anggota->nama }}</td>
                                <td>
                                    <form action="{{ route('cart.update',$item) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <select onchange="submit()" name="golongan" id="golongan" class="form-control">
                                            @foreach ($pramuka as $golongan)
                                                <option value="{{ $golongan->id }}" {{ $golongan->id == $item->golongan?'selected':'' }}>{{ $golongan->name }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                                <td>Rp. {{ number_format($item->harga) }}</td>
                                <td>
                                    <button type="submit" class="btn btn-danger" onclick="deleteCart({{ $item->id }})"><i class="icofont-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        function deleteCart(id){
            if(confirm('are you sure?')){
                $.ajax({
                    type: "DELETE",
                    url: "{{ url('api/cart/delete') }}"+'/'+id,
                    success: function (response) {
                        alert('Item berhasil dihapus');
                        location.reload();
                    }
                });
            }
        }
    </script>
@endsection
